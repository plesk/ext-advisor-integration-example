// Copyright 1999-2025. WebPros International GmbH. All rights reserved.

const pleskConfig = require('@plesk/eslint-config');

module.exports = [
  pleskConfig,
  {
    languageOptions: {
      globals: {
        Jsw: false,
      },
    },
    settings: {
      react: {
        pragma: 'createElement',
      },
    },
    rules: {
      'react/react-in-jsx-scope': 'off',
    },
  },
];
