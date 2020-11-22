import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

const opts = {
    theme: {
        themes: {
            light: {
                primary: '#E53935',
                secondary: '#FFCDD2',
                accent: '#3F51B5'
            },
        },
    },
}

export default new Vuetify(opts)
