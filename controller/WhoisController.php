<?php
/**
 * 万网whois接口
 * http://www.docin.com/p-222889504.html
 * @author Administrator
 *
 */
error_reporting ( E_ERROR | E_WARNING | E_PARSE );
ini_set ( 'display_errors', 'off' ); //线上设置为off
class WhoisController {
    
    public function indexAction() {
    
    }
    
    public function run() {
        $x = '';
        $y = '';
        foreach ( range ( 'a', 'z' ) as $x ) {
            foreach ( range ( 'a', 'z' ) as $y ) {
                $xy = $x . $y;
                $domain = $xy . '.com';
                $url = "http://panda.www.net.cn/cgi-bin/check.cgi?area_domain={$domain}";
                $res = $this->curlGet ( $url );
                $code = explode ( ':', $res ['property'] ['original'] );
                if (trim ( $code [0] ) != '211') {
                    $tmp [] = $domain;
                }
            }
        }
        var_dump ( $tmp );
    }
    
    private function curlGet($url) {
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url ); //需要获取的URL地址，也可以在curl_init()函数中设置。
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE ); //将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。
        $result = curl_exec ( $ch );
        //var_dump ( $result );
        //$info = curl_getinfo ( $ch ); //得到返回信息的特性
        //print_r ( $info );
        curl_close ( $ch );
        return XmlTool::xml2Arr ( $result );
    }
}
$whois = new WhoisController ();
$whois->run ();

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
