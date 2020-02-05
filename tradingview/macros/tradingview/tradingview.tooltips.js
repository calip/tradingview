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
$(document).on('mouseenter', '[rel="tradingview-tooltip"]', function () {
    var target = $(this);
    var tip = target.attr('title');
    var tooltip = $('<div id="tradingview-tooltip"></div>');

    if (!tip || tip == '')
        return false;

    target.removeAttr('title');
    tooltip.css('opacity', 0)
            .html(tip)
            .appendTo('body');

    var init_tooltip = function ()
    {
        tooltip.css('max-width', 730);

        var pos_left = target.offset().left + (target.outerWidth() / 2) - (tooltip.outerWidth() / 2),
                pos_top = target.offset().top - tooltip.outerHeight() - 20;

        if (pos_left < 0)
        {
            pos_left = target.offset().left + target.outerWidth() / 2 - 20;
            tooltip.addClass('left');
        } else
            tooltip.removeClass('left');

        if (pos_left + tooltip.outerWidth() > $(window).width())
        {
            pos_left = target.offset().left - tooltip.outerWidth() + target.outerWidth() / 2 + 20;
            tooltip.addClass('right');
        } else
            tooltip.removeClass('right');

        if (pos_top < 0)
        {
            var pos_top = target.offset().top + target.outerHeight();
            tooltip.addClass('top');
        } else
            tooltip.removeClass('top');

        tooltip.css({left: pos_left, top: pos_top})
                .animate({top: '+=10', opacity: 1}, 50);
    };

    init_tooltip();
    $(window).resize(init_tooltip);

    var remove_tooltip = function ()
    {
        document.onclick = function (e) {
            if (e.target.id !== 'tradingview-tooltip') {
                tooltip.animate({top: '-=10', opacity: 0}, 50, function ()
                {
                    $(this).remove();
                });

                target.attr('title', tip);
            }
        }
    };

    $(document).on('mouseleave', '#tradingview-link', remove_tooltip);
});