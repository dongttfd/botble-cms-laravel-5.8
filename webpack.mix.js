let glob = require('glob');

require('./platform/core/webpack.mix.js');

glob.sync('./platform/packages/*/webpack.mix.js').forEach(config => {
    require(config);
});

glob.sync('./platform/themes/*/webpack.mix.js').forEach(config => {
    require(config);
});

glob.sync('./platform/plugins/*/webpack.mix.js').forEach(config => {
    require(config);
});
