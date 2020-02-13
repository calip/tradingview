<?php
/**
 * Trading View - Configuration
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
if (!defined('SCHLIX_VERSION'))
    die('No Access');
?>
<p><?= ___('This macro is useful to embed a trading view chart in the middle of content text') ?></p>
<p><?= ___('More information about Trading View <a href="https://id.tradingview.com/widget/" target="_blank">Click Here</a>.') ?></p>

<h3><?= ___('Usage') ?></h3>
<h4><?= ___('Syntax') ?></h4>
<p><?= ___('Default') ?>: <code style="font-size:large;">{{<strong>AAPL</strong>}}</code></p>
<p><?= ___('Advance') ?>: <code style="font-size:large">{{<strong>AAPL</strong> <strong>title</strong>=<em>&quot;Apple&quot;</em> <strong>type</strong>=<em>&quot;candle&quot;</em> <strong>theme</strong>=<em>&quot;light&quot;</em> <strong>timeframe</strong>=<em>&quot;daily&quot;</em> <strong>hover</strong>=<em>&quot;true&quot;</em>}}</code></p>
<h4><?= ___('Available Type value:') ?></h4>
<ul>
    <li><?= ___('candle') ?></li>
    <li><?= ___('line') ?></li>
    <li><?= ___('bar') ?></li>
    <li><?= ___('area') ?></li>
    <li><?= ___('renko') ?></li>
    <li><?= ___('kagi') ?></li>
</ul>
<h4><?= ___('Available Theme value:') ?></h4>
<ul>
    <li><?= ___('light') ?></li>
    <li><?= ___('dark') ?></li>
</ul>
<h4><?= ___('Available Timeframe value:') ?></h4>
<ul>
    <li><?= ___('daily') ?></li>
    <li><?= ___('weekly') ?></li>
    <li><?= ___('monthly') ?></li>
</ul>