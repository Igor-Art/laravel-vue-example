/* eslint-env node */
module.exports = {
  "root": true,
  "env": {
    "node": true,
  },
  "extends": [
    "plugin:vue/vue3-essential",
    "eslint:recommended"
  ],
  "rules": {
    "no-unused-vars": "off",
    "vue/multi-word-component-names": "off"
  },
  "parserOptions": {
    "ecmaVersion": "latest"
  }
}
