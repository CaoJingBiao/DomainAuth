<?php
function creatkami()
{   
	 $kami = '';
	 //将你想要的字符添加到下面字符串中，默认是数字0-9和26个英文字母
	 $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
	 $char_len = strlen($chars); 
	 for($i=0;$i<20;$i++){
	 $loop = mt_rand(0, ($char_len-1));
	 //将这个字符串当作一个数组，随机取出一个字符，并循环拼接成你需要的位数
	 $kami .= $chars[$loop];
	 }
	 return $kami;
}

function execlkami(){
	//导出
        $path = dirname(__FILE__); //找到当前脚本所在路径
        vendor("PHPExcel.PHPExcel.PHPExcel");
        vendor("PHPExcel.PHPExcel.Writer.IWriter");
        vendor("PHPExcel.PHPExcel.Writer.Abstract");
        vendor("PHPExcel.PHPExcel.Writer.Excel5");
        vendor("PHPExcel.PHPExcel.Writer.Excel2007");
        vendor("PHPExcel.PHPExcel.IOFactory");
        $excel = new \PHPExcel();
        $sql = db('kami')->select();   


        /*--------------设置表头信息------------------*/
        $excel->setActiveSheetIndex(0)
        ->setCellValue('A1', '卡密编号')
        ->setCellValue('B1', '卡密列表')
        ->setCellValue('C1', '周期/年')
        ->setCellValue('D1', '生成时间')
        ;

        /*--------------开始从数据库提取信息插入Excel表中------------------*/

        $i=2;  //定义一个i变量，目的是在循环输出数据是控制行数
        $count = count($sql);  //计算有多少条数据
        for ($i = 2; $i <= $count+1; $i++) {
            $excel->getActiveSheet()->setCellValue('A' . $i, $sql[$i-2]['id']);
            $excel->getActiveSheet()->setCellValue('B' . $i, $sql[$i-2]['km']);
            $excel->getActiveSheet()->setCellValue('C' . $i, $sql[$i-2]['time']);
            $excel->getActiveSheet()->setCellValue('D' . $i, date('Y-m-d H:i:s',$sql[$i-2]['ctime']));
        }


        $excel->getActiveSheet()->setTitle('卡密详情');
        $excel->setActiveSheetIndex(0); 

        //创建Excel输入对象
        header('Content-Type: application/vnd.ms-excel');
        header('Cache-Control: max-age=0');
        header('Content-Disposition:attachment;filename="卡密列表('.date('Y-m-d').').xls"');
        ob_clean();
        flush();
        $objWriter = \PHPExcel_IOFactory:: createWriter($excel, 'Excel5'); 
        $objWriter->save( 'php://output');	
}
?>