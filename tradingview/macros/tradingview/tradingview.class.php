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
    
    
    private function getAttributesFromText($html_string, $open_tag = '{{', $close_tag = '}}')
    {
        $attrs = [];
        $regex = '#'.$open_tag.'(.*?)'.$close_tag.'#iU';
        
        $match_count = preg_match_all($regex, $html_string, $attrmatches);
        if ($match_count > 0) {
            for ($i = 0; $i < $match_count; $i++) { 
                $str_attr = $attrmatches[1][$i];
                $attributes = explode(" ", $str_attr);
                preg_match_all('/\s+?(.+)="([^"]*)"/U', $str_attr, $extra_attrs, PREG_SET_ORDER);
                if ($extra_attrs) {
                    foreach ($extra_attrs as $attr) {
                        $key = alpha_numeric_with_dash_underscore($attr[1]);
                        $attrs[$i]['attributes'][$key] = strip_tags($attr[2]);
                        
                    }
                    $attrs[$i]['macro'] = $attrmatches[0][$i];
                }
                $attrs[$i]['attributes']['symbol'] = strip_tags($attributes[0]);
                $attrs[$i]['macro'] = $attrmatches[0][$i];
            }
            
            return $attrs;
        }
        return NULL;
    }
    
    private function processText($text) {
        $insert_macros = $this->getAttributesFromText($text, '{{', '}}');
        if ($insert_macros)
        {
            foreach ($insert_macros as $insert_macro)
            {
                $attrs = $insert_macro['attributes'];
                $macro = $insert_macro['macro'];
                
                $symbol = $attrs['symbol'];
                if ($symbol != null)
                {
                    $theme = ($attrs['theme']) ? $attrs['theme'] : 'light';
                    $title = ($attrs['title']) ? $attrs['title'] : $symbol;
                    $hover = ($attrs['hover'] === 'true') ? 1 : 0;
                    $attr_type = ($attrs['type']) ? $attrs['type'] : 'candle';
                    $obj_type = array('bar' => 0, 'candle' => 1, 'line' => 2, 'area' => 3, 'renko' => 4, 'kagi' => 5);
                    $type = $obj_type[$attr_type];
                    
                    $attr_timeframe = ($attrs['timeframe']) ? $attrs['timeframe'] : 'daily';
                    $obj_timeframe = array('daily' => 'D', 'weekly' => 'W', 'monthly' => 'M');
                    $timeframe = $obj_timeframe[$attr_timeframe];
                    
                    start_output_buffer();
                    $this->loadTemplateFile('view.macro', array('symbol' => $symbol, 'type' => $type, 'theme' => $theme, 'timeframe' => $timeframe, 'title' => $title, 'hover' => $hover), false);
                    $replacement_tag = end_output_buffer();
                    $text = str_replace($macro, $replacement_tag, $text);
                }
            }
        }
        static::$has_this_macro_been_called = 'yes';
        return $text;
    }
    
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
        global $HTMLHeader;
        if (static::$has_this_macro_been_called != 'yes'){

            if (is_array($data)) { // don't enable it for block (string)
                if (array_key_exists('summary', $data))
                    $data['summary'] = $this->processText($data['summary']);
                if (array_key_exists('description', $data))
                    $data['description'] = $this->processText($data['description']);
            } else{
                $data = $this->processText($data);
            }

            return true;
        }
    }

}
            