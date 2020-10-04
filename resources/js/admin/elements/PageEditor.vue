<template>
    <div class="page-editor">
        <div class="page-editor__header">
            <b-button @click="addParagraph">Paragraph</b-button>
            <b-button @click="addLink">link</b-button>
        </div>
        <div class="page-editor__content">
            <component v-for="element in content"
                       :is="element.component"
                       :options="element.options"
                       :content="element.childElements"
            ></component>
        </div>
    </div>
</template>

<script>
    import PComponent from "./editor/PComponent";
    import AComponent from "./editor/AComponent";
    import DivComponent from "./editor/DivComponent";

    export default {
        name: "PageEditor",
        components: {
            PComponent,
            AComponent,
            DivComponent
        },
        data: () => ({
            content : [

            ],
            text : ' <div>\n' +
                '                <p>Test <a href="#">Link</a></p>\n' +
                '            </div>'
        }),
        created() {
            this.parse();
        },
        methods: {
            parse() {
                let domParser = new DOMParser(),
                    parsedContent = domParser.parseFromString(this.text, 'text/html'),
                    elements = parsedContent.body.children;

                this.content = this.recursiveParse(elements);
            },
            recursiveParse(elements) {
                let content = [];
                for (let i = 0; i < elements.length; i++) {
                    let parsedElement = {};

                    parsedElement.component = this.createComponentName(elements[i].tagName);
                    parsedElement.options = {};

                    if (elements[i].children.length) {
                        parsedElement.childElements = this.recursiveParse(elements[i].children, content);
                    } else {
                        parsedElement.childElements = [];
                    }

                    content.push(parsedElement);
                }

                return content;
            },
            createComponentName(tagName) {
                return `${tagName.capitalize()}Component`;
            },
            addParagraph() {
                this.content.push({
                    component : 'ParagraphComponent',
                    options : {
                        content : 'I am a paragraph'
                    },
                    childElements : [
                        {
                            component : 'LinkComponent',
                            options : {
                                href: 'google.com',
                                target: '_blank',
                                content : 'I am a link'
                            }
                        }
                    ]
                })
            },
            addLink() {
                this.content.push({
                    component : 'LinkComponent',
                    options : {
                        href: 'google.com',
                        target: '_blank',
                        isRouterLink : false,
                        content : 'I am a link'
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
