/**
 * Trading View - macro class
 * 
 * TradingView is a financial platform for self-directed traders and investors.
 * 
 * @copyright 2020 Beplas Studio
 *
 * @license MIT
 *
 * @package tradingview
 * @version 1.0
 * @author  Beplas Studio <alip@beplasstudio.com>
 * @link    https://beplasstudio.com/
 */
function tradingview_render()
{
    var findAllTrading = function (regexPattern, sourceString) {
        let output = []
        let match

        let regexPatternWithGlobal = RegExp(regexPattern, "g")
        while (match = regexPatternWithGlobal.exec(sourceString)) {
            delete match.input
            output.push(match)
        }
        return output
    }
    var getTradingAttributesFromText = function (html_string, prefix, open_tag = '{', close_tag = '}')
    {
        var attrs = [];
        var regex = open_tag + prefix + '([^}]+)' + close_tag;

        var matches = findAllTrading(regex, html_string);
        if (matches.length > 0) {
            for (var i = 0; i < matches.length; i++) {
                var str_attr = matches[i][1];

                var extra_attrs = findAllTrading(/\s+(?=.*symbol="([^\s+]+)"|)(?=.*type="([^\s+]+)"|)(?=.*theme="([^\s+]+)"|)(?=.*timeframe="([^\s+]+)"|).+$/, str_attr);

                if (extra_attrs.length > 0) {
                    var obj = {};
                    for (var x = 0; x < extra_attrs.length; x++) {
                        obj.attributes = {
                            symbol: extra_attrs[x][1],
                            type: extra_attrs[x][2],
                            theme: extra_attrs[x][3],
                            timeframe: extra_attrs[x][4]
                        };
                    }
                    obj.macro = matches[i][0];
                    attrs.push(obj);
                }
            }
            return attrs;
        }
        return null;
    }
    var processTradingText = function ()
    {
        var text = $('[itemprop="articleSection"]')[0].innerHTML;
        var insert_macros = getTradingAttributesFromText(text, 'inserttradingview');
        if (insert_macros) {
            for (var i = 0; i < insert_macros.length; i++) {
                var attrs = insert_macros[i].attributes;
                var macro = insert_macros[i].macro;
                var theme = (attrs.theme !== undefined) ? attrs.theme : 'light';
                var type_attr = (attrs.type !== undefined) ? attrs.type : 'candle';

                var ty = {bar: 0, candle: 1, line: 2, area: 3, renko: 4, kagi: 5};
                var type = ty[type_attr];

                var tm = {daily: 'D', weekly: 'W', monthly: 'M'};
                var timeframe = attrs.timeframe !== undefined ? tm[attrs.timeframe] : 'D';

                if (attrs.symbol != undefined)
                {
                    var url = 'https://s.tradingview.com/widgetembed/?symbol=' + attrs.symbol + '&interval=' + timeframe + '&theme=' + theme + '&style=' + type;
                    var embed = '<iframe height="500" style="width: 100%; margin: 0 !important; padding: 0 !important;" frameborder="0" allowtransparency="true" scrolling="no" allowfullscreen="" src="' + encodeURI(url) + '"></iframe>';
                    text = text.replace(macro, embed);
                }
            }
        }
        //hover
        var hover_macros = getTradingAttributesFromText(text, 'tradingviewhover');

        if (hover_macros) {
            for (var i = 0; i < hover_macros.length; i++) {
                var attrs = hover_macros[i].attributes;
                var macro = hover_macros[i].macro;
                var theme = (attrs.theme !== undefined) ? attrs.theme : 'light';
                var type_attr = (attrs.type !== undefined) ? attrs.type : 'candle';

                var ty = {bar: 0, candle: 1, line: 2, area: 3, renko: 4, kagi: 5};
                var type = ty[type_attr];

                var tm = {daily: 'D', weekly: 'W', monthly: 'M'};
                var timeframe = attrs.timeframe !== undefined ? tm[attrs.timeframe] : 'D';

                if (attrs.symbol != undefined)
                {
                    var embed = '<iframe height=500 width=500 style=margin:0!important;padding:0!important; frameborder=0 allowtransparency=true scrolling=no allowfullscreen src=https://s.tradingview.com/widgetembed/?symbol=' + attrs.symbol + '&interval=' + timeframe.toUpperCase() + '&theme=' + theme + '&style=' + type + '></iframe>';
                    var tag = '<a href="#" id="tradingview-link" title="' + embed + '" rel="tradingview-tooltip" style="white-space: nowrap;">' + attrs.symbol + '</a>';

                    text = text.replace(macro, tag);
                }
            }
        }
        $('[itemprop="articleSection"]')[0].innerHTML = text;
    }
    processTradingText();
}
tradingview_render();