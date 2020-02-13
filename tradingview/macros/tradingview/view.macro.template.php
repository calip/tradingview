<?php
/**
 * Trading View
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
if (!defined('SCHLIX_VERSION')) die('No Access');
$this->CSS('tradingview.tooltips.css');
$this->JAVASCRIPT('tradingview.tooltips.js');
?>
<?php if ($hover) : ?>
    <a href="javascript:void(0)" id="tradingview-link" title="<iframe height='350' style='width: 500px; margin:0!important;padding:0!important;' frameborder='0' allowtransparency='true' scrolling='no' src='https://s.tradingview.com/widgetembed/?symbol=<?= ___($symbol)?>&interval=<?= ___($timeframe)?>&theme=<?= ___($theme)?>&style=<?= ___($type)?>'></iframe>" rel="tradingview-tooltip" style="white-space: nowrap;"><?= ___($title)?></a>    
<?php else: ?>
    <iframe height="500" style="width: 100%; margin: 0 !important; padding: 0 !important;" frameborder="0" allowtransparency="true" scrolling="no" src="https://s.tradingview.com/widgetembed/?symbol=<?= ___($symbol)?>&interval=<?= ___($timeframe)?>&theme=<?= ___($theme)?>&style=<?= ___($type)?>"></iframe>
<?php endif; ?>