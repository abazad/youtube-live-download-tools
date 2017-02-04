<?php                           $klasoradi = "/var/www/html/kayit/".date('F-d-m-Y');
                                
                                if (file_exists($klasoradi))
                                
                                {
                                
                                echo "klasör mevcut";
                                
                                }else{
                                
                                mkdir($klasoradi ,0777 );
                                echo "klasör olusturuldu.";
                                
                                }

                               /**/
                                $youtube_id     =   "ffFIDo16Q0Q";
                                $tarih          =   date('d.m.Y-H:i:s');
                                $youtube_mp4    =   $klasoradi."/".$youtube_id."_".$tarih;
                                $youtube        =   "https://www.youtube.com/watch?v=".$youtube_id;
                                $download_txt   =   $klasoradi.'/'.$tarih.".txt";
                                $youtube_xml    =   "sudo livestreamer  ".$youtube."  best --stream-url --yes-run-as-root > ".$download_txt;
                                
                                exec($youtube_xml, $sonuc_xml);
                                
                                
                                $txt            = fopen($download_txt, 'r');
                                $txt_xml        = trim(fread($txt, filesize($download_txt)));

                                $komut = "sudo ffmpeg -i ".$txt_xml." -ss 00:00:00 -t 01:01:00 ".$youtube_mp4.".mp4 ";
                                
                                $download_sh = $klasoradi."/download-".$tarih.".sh";

                                $dosya = fopen($download_sh, 'w');
                                fwrite($dosya, $komut);
                                fclose($dosya);              

                                $sh = "sh ".$download_sh." & rm -rf ".$download_sh." & rm -rf ".$download_txt;
                                exec($sh, $sonuc); 
                                ?>
