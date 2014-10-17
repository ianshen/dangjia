<?php
/**
 * 解析XML类
 * @author Ian
 *
 */
class XmlTool {
    /**
     * 根据url解析xml
     * @param string $url xml地址
     * @param array $xmlar 解析xml内容的数组
     */
    static function parser_xml_by_url($url, &$xmlar) {
        $handle = fopen ( $url, "rb" );
        $contents = "";
        do {
            $data = fread ( $handle, 8192 );
            if (strlen ( $data ) == 0)
                break;
            $contents .= $data;
        } while ( true );
        fclose ( $handle );
        self::get_xml_tree ( $contents, $xmlar );
        return 1;
    }
    
    static function xml2Arr($xml) {
        $arr = array ();
        self::get_xml_tree ( $xml, $arr );
        return $arr;
    }
    
    /**
     * 获取xml树
     * @param string $xmldata xml数据
     * @param array $result xml内容
     */
    static function get_xml_tree($xmldata, &$result) {
        ini_set ( 'track_errors', '1' );
        $xmlreaderror = false;
        $parser = xml_parser_create ();
        xml_parser_set_option ( $parser, XML_OPTION_SKIP_WHITE, 1 );
        xml_parser_set_option ( $parser, XML_OPTION_CASE_FOLDING, 0 );
        if (! xml_parse_into_struct ( $parser, $xmldata, $vals, $index )) {
            $xmlreaderror = true;
            return 0;
        }
        xml_parser_free ( $parser );
        if (! $xmlreaderror) {
            $result = array ();
            $i = 0;
            if (isset ( $vals [$i] ['attributes'] )) {
                foreach ( array_keys ( $vals [$i] ['attributes'] ) as $attkey ) {
                    $attributes [$attkey] = $vals [$i] ['attributes'] [$attkey];
                }
            }
            $result [$vals [$i] ['tag']] = array_merge ( ( array ) $attributes, self::get_children ( $vals, $i, 'open' ) );
        }
        ini_set ( 'track_errors', '0' );
        return 1;
    }
    
    /**
     * 获取子节点
     * @param array $vals
     * @param integer $i
     * @param string $type
     */
    static function get_children($vals, &$i, $type) {
        if ($type == 'complete') {
            if (isset ( $vals [$i] ['value'] )) {
                return ($vals [$i] ['value']);
            } else {
                return '';
            }
        }
        $children = array ();
        while ( $vals [++ $i] ['type'] != 'close' ) {
            $type = $vals [$i] ['type'];
            if (isset ( $children [$vals [$i] ['tag']] )) {
                if (is_array ( $children [$vals [$i] ['tag']] )) {
                    $temp = array_keys ( $children [$vals [$i] ['tag']] );
                    if (is_string ( $temp [0] )) {
                        $a = $children [$vals [$i] ['tag']];
                        unset ( $children [$vals [$i] ['tag']] );
                        $children [$vals [$i] ['tag']] [0] = $a;
                    }
                } else {
                    $a = $children [$vals [$i] ['tag']];
                    unset ( $children [$vals [$i] ['tag']] );
                    $children [$vals [$i] ['tag']] [0] = $a;
                }
                
                $children [$vals [$i] ['tag']] [] = self::get_children ( $vals, $i, $type );
            } else {
                $children [$vals [$i] ['tag']] = self::get_children ( $vals, $i, $type );
            }
            
            if (isset ( $vals [$i] ['attributes'] )) {
                $attributes = array ();
                foreach ( array_keys ( $vals [$i] ['attributes'] ) as $attkey )
                    $attributes [$attkey] = $vals [$i] ['attributes'] [$attkey];
                if (isset ( $children [$vals [$i] ['tag']] )) {
                    if ($children [$vals [$i] ['tag']] == '') {
                        unset ( $children [$vals [$i] ['tag']] );
                        $children [$vals [$i] ['tag']] = $attributes;
                    } elseif (is_array ( $children [$vals [$i] ['tag']] )) {
                        $index = count ( $children [$vals [$i] ['tag']] ) - 1;
                        if ($children [$vals [$i] ['tag']] [$index] == '') {
                            unset ( $children [$vals [$i] ['tag']] [$index] );
                            $children [$vals [$i] ['tag']] [$index] = $attributes;
                        }
                        $children [$vals [$i] ['tag']] [$index] = array_merge ( $children [$vals [$i] ['tag']] [$index], $attributes );
                    } else {
                        $value = $children [$vals [$i] ['tag']];
                        unset ( $children [$vals [$i] ['tag']] );
                        $children [$vals [$i] ['tag']] ['value'] = $value;
                        $children [$vals [$i] ['tag']] = array_merge ( $children [$vals [$i] ['tag']], $attributes );
                    }
                } else {
                    $children [$vals [$i] ['tag']] = $attributes;
                }
            }
        }
        return $children;
    }
}
?>