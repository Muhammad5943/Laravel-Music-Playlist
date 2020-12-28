window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');

require('bootstrap'); /* basic javascript */

import 'select2' /* esx */


window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

require('./components/Delete')
require('./components/lyrics/Create')
