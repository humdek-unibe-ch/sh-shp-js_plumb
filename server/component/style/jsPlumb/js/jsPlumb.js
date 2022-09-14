jQuery(document).ready(function () {
    $(".jsPlumb-style").each(function () {
        var jsPlumbConfig = $(this).data('jsplumb');
        var jsPlumbGlobalSettings = jsPlumbConfig['config'] ? jsPlumbConfig['config'] : {};
        jsPlumbGlobalSettings['container'] = this;
        const jsPlumbInstance = jsPlumbBrowserUI.newInstance(jsPlumbGlobalSettings);

        if (jsPlumbConfig['classes']) {
            for (const [className, connectionConfig] of Object.entries(jsPlumbConfig['classes'])) {
                var source;
                var target;
                $(this).find(className).each(function () {
                    target = this;
                    if (source && target) {
                        var config = connectionConfig;
                        config['source'] = source;
                        config['target'] = target;
                        jsPlumbInstance.connect(connectionConfig);
                    }
                    source = this;
                });
            }
        }
    })
});