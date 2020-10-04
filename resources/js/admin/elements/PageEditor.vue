<template>
    <div class="page-editor">
        <div class="page-editor__header">
            <b-button @click="addParagraph">Paragraph</b-button>
            <b-button @click="addLink">link</b-button>
        </div>
        <div class="page-editor__content">
            <template v-for="element in content">
                <template v-if="element.isText">
                    {{ element.content }}
                </template>
                <component v-else
                           :is="element.component"
                           :options="element.options"
                           :childElements="element.childElements"
                           :content="element.content"
                ></component>
            </template>
        </div>
    </div>
</template>

<script>
    import EditorComponents from "../scripts/editor-components";

    export default {
        name: "PageEditor",
        components: EditorComponents,
        data: () => ({
            content : [

            ],
            text : '<ul>\n' +
                '   <li>Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.</li>\n' +
                '</ul>\n' +
                '            '
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

                    parsedElement.content = elements[i].nodeValue;

                    if (elements[i].nodeName === "#text") {
                        parsedElement.isText = true;
                    } else {
                        parsedElement.isText = false;
                        parsedElement.component = this.createComponentName(elements[i].tagName);
                        parsedElement.options = this.parseElementsAttributes(elements[i]);
                        if (elements[i].childNodes.length) {
                            parsedElement.childElements = this.recursiveParse(elements[i].childNodes, content);
                        } else {
                            parsedElement.childElements = [];
                        }
                    }

                    content.push(parsedElement);
                }

                return content;
            },
            createComponentName(tagName) {
                return `${tagName.capitalize()}Component`;
            },
            parseElementsAttributes(element) {
                let attributes = {};
                for (let i = 0; i < element.attributes.length; i++) {
                    attributes[ element.attributes[i].name ] = element.attributes[i].value;
                }

                return attributes;
            },
            addParagraph() {
                this.content.push({
                    component : 'PComponent',
                    options : {

                    },
                    childElements : [
                        {
                            component : 'AComponent',
                            options : {
                                href: 'google.com',
                                target: '_blank',
                            },
                            childElements: [
                                {
                                    content : 'I am a link',
                                    isText : true
                                }
                            ]
                        }
                    ]
                })
            },
            addLink() {
                this.content.push({
                    component : 'AComponent',
                    options : {
                        href: 'google.com',
                        target: '_blank',
                        isRouterLink : false,
                    },
                    childElements: [
                        {
                            content : 'I am a link',
                            isText : true
                        }
                    ]
                })
            }
        }
    }
</script>

<style scoped>

</style>
