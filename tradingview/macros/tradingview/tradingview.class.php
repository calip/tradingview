<?php
namespace Macro;
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

class TradingView extends \SCHLIX\cmsMacro {

    
    protected static $has_this_macro_been_called;
    /*
     * Run the macro
     * @global \SCHLIX\cmsHTMLPageHeader $HTMLHeader
     * @param array|string $data
     * @param object $caller_object
     * @param string $caller_function
     * @param array $extra_info
     * @return bool
     */
    public function Run(&$data, $caller_object, $caller_function, $extra_info = NULL) {
        if (static::$has_this_macro_been_called != 'yes')
        {
            $this->loadTemplateFile('view.macro', compact(array_keys(get_defined_vars())));
            static::$has_this_macro_been_called = 'yes';
        }
        return true;
    }

}
            