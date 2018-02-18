<?php


class HTML_Form {
    /**
     * @var
     */
    
    private $tag;
    private $xhtml;

    /**
     * HTML_Form constructor.
     * @param bool $xhtml
     */
    
    function __construct($xhtml = true) {
        $this->xhtml = $xhtml;
    }

    /**
     * @param string $action
     * @param string $method
     * @param string $id
     * @param array $attr_ar
     * @return string
     */
    function startForm($action = '#', $method = 'post', $id = '', $attr_ar = array() ) {
        $str = "<form action=\"$action\" method=\"$method\"";
        if ( !empty($id) ) {
            $str .= " id=\"$id\"";
        }
        $str .= $attr_ar? $this->addAttributes( $attr_ar ) . '>': '>';
        return $str;
    }

    /**
     * @param $attr_ar
     * @return string
     */
    
    private function addAttributes( $attr_ar ) {
        $str = '';
        // check minimized (boolean) attributes
        $min_atts = array('checked', 'disabled', 'readonly', 'multiple',
                'required', 'autofocus', 'novalidate', 'formnovalidate'); // html5
        foreach( $attr_ar as $key=>$val ) {
            if ( in_array($key, $min_atts) ) {
                if ( !empty($val) ) { 
                    $str .= $this->xhtml? " $key=\"$key\"": " $key";
                }
            } else {
                $str .= " $key=\"$val\"";
            }
        }
        return $str;
    }

    /**
     * @param $type
     * @param $name
     * @param $value
     * @param array $attr_ar
     * @return string
     */
    
    function addInput($type, $name, $value, $attr_ar = array() ) {
        $str = "<input type=\"$type\" name=\"$name\" value=\"$value\"";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= $this->xhtml? ' />': '>';
        return $str;
    }

    /**
     * @param $name
     * @param int $rows
     * @param int $cols
     * @param string $value
     * @param array $attr_ar
     * @return string
     */
    function addTextarea($name, $rows = 4, $cols = 30, $value = '', $attr_ar = array() ) {
        $str = "<textarea name=\"$name\" rows=\"$rows\" cols=\"$cols\"";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= ">$value</textarea>";
        return $str;
    }
    /**
     * @param $forID
     * @param $text
     * @param array $attr_ar
     * @return string
     */
    
    // for attribute refers to id of associated form element
    function addLabelFor($forID, $text, $attr_ar = array() ) {
        $str = "<label for=\"$forID\"";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= ">$text</label>";
        return $str;
    }
    /**
     * @param $name
     * @param $val_list
     * @param $txt_list
     * @param null $selected_value
     * @param null $header
     * @param array $attr_ar
     * @return string
     */
    
    // from parallel arrays for option values and text
    function addSelectListArrays($name, $val_list, $txt_list, $selected_value = NULL,
            $header = NULL, $attr_ar = array() ) {
        $option_list = array_combine( $val_list, $txt_list );
        $str = $this->addSelectList($name, $option_list, true, $selected_value, $header, $attr_ar );
        return $str;
    }
    /**
     * @param $name
     * @param $option_list
     * @param bool $bVal
     * @param null $selected_value
     * @param null $header
     * @param array $attr_ar
     * @return string
     */
    // option values and text come from one array (can be assoc)
    // $bVal false if text serves as value (no value attr)
    function addSelectList($name, $option_list, $bVal = true, $selected_value = NULL,
            $header = NULL, $attr_ar = array() ) {
        $str = "<select name=\"$name\"";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= ">\n";
        if ( isset($header) ) {
            $str .= "  <option value=\"\">$header</option>\n";
        }
        foreach ( $option_list as $val => $text ) {
            $str .= $bVal? "  <option value=\"$val\"": "  <option";
            if ( isset($selected_value) && ( $selected_value === $val || $selected_value === $text) ) {
                $str .= $this->xhtml? ' selected="selected"': ' selected';
            }
            $str .= ">$text</option>\n";
        }
        $str .= "</select>";
        return $str;
    }

    /**
     * @return string
     */
    function endForm() {
        return "</form>";
    }

    /**
     * @param $tag
     * @param array $attr_ar
     * @return string
     */
    function startTag($tag, $attr_ar = array() ) {
        $this->tag = $tag;
        $str = "<$tag";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= '>';
        return $str;
    }

    /**
     * @param string $tag
     * @return string
     */
    function endTag($tag = '') {
        $str = $tag? "</$tag>": "</$this->tag>";
        $this->tag = '';
        return $str;
    }

    /**
     * @param $tag
     * @param array $attr_ar
     * @return string
     */
    function addEmptyTag($tag, $attr_ar = array() ) {
        $str = "<$tag";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= $this->xhtml? ' />': '>';
        return $str;
    }
    
}

?>