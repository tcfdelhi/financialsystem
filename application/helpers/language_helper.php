<?php


function languagedata($val, $for_data)
{
    if ($val != '') {
        $val = $val;
    } else {
        $val = 'japanese';
    }
    $CI = &get_instance();
    $for_data = trim($for_data);
    $query = $CI->db->query("select $val as finalresult from ci_languages where english='$for_data'");
    foreach (@$query->result_array() as $resr) {
        @$val2 = $resr['finalresult'];
    }
    if (@$val2 != '') {
        print @$val2;
    } else {
        print @$for_data;
    }
}
