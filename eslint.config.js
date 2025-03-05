import pluginVue from 'eslint-plugin-vue'
import globals from 'globals'

export default [
  // add more generic rulesets here, such as:
  // js.configs.recommended,
  ...pluginVue.configs['flat/recommended'],
  // ...pluginVue.configs['flat/vue2-recommended'], // Use this if you are using Vue.js 2.x.
  {
    ignores: ['vendor/*'],
  },
  {
    
    rules: {
      // override/add rules settings here, such as:
      // 'vue/no-unused-vars': 'error'
      'vue/html-indent': ['error', 4]
    },
    languageOptions: {
      sourceType: 'module',
      globals: {
        ...globals.browser
      }
    }
  }
]