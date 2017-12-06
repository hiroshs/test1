<?php


//変更してみた

/*
ちゃんとへんこうされているか？確認。

追記。

2回目変更


3回目変更
*/


session_start();
//	入り口を限定
$host = php_uname( "n" );

//if ( !isset($_SERVER["HTTP_REFERER"]) ) {
	//	上記入り口から入った場合のみ、アクセス権を与える
	$_SESSION["URef"] ="";	// $_SERVER["HTTP_REFERER"];
	$_SESSION["UID"] = session_id();
	$_SESSION["UName"] = "employ";
	$_SESSION["UHdl"] = "someone";
	$_SESSION["ULevel"] = 5;
	$_SESSION["AccCnt"] = 0;
//}

	$_SESSION["ErrMsg"] = "";

//	セキュリティートラップ
include "./security_pub.php";


//if ( isset( $terakoya_id )){
// echo  "terakoya_id=$terakoya_id<br>";
//}


include "./solution/mgmt/func_connect_db.php";


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//E"N">
<HTML><HEAD><TITLE>Home ICT Solution TOPページ</TITLE>
<META content="text/html; charset=UTF-8" http-equiv=Content-Type>
<link rel="stylesheet" type="text/css" href="./style.css" />
<META name=GENERATOR content="MSHTML 8.00.6001.1999"></HEAD>
<body bgColor=#ffffff>


<div class="sol_top">
<!-- *************** ヘッダ ***************** -->

	<div class="header">
		<TABLE border=0 cellSpacing=0 borderColor=#ffffff cellPadding=0 width="100%">
			<TBODY>
			<TR>
				<TD>
					<IMG src="./images/title.bmp" width=404 height=75>
				</TD>
				<TD vAlign=bottom>
					<DIV align=right><A href="http://www.sws-lab.com/index.html"><IMG border=0 
							src="./images/rogo01.bmp" width=132 height=40></A>
					</DIV>
				</TD>
			</TR>
			<TR>
				<TD colSpan=2>
					<HR style="FILTER: alpha(opacity=0,finishopacity=100,style=1 startX=100,startY=100,finishX=0,finishY=0)" 
					color=#8040ff SIZE=8>
				</TD>
			</TR>
			<TR>
				<TD colSpan=2>
					<HR style="FILTER: alpha(opacity=0,finishopacity=100,style=1 startX=100,startY=100,finishX=0,finishY=0)" 
					color=#ffffff SIZE=8>
				</TD>
			</TR>

			<TR>
			<TD vAlign=bottom noWrap>
				<IMG src="./images/bit.gif" width=3>

				<A href="./index2.php"><IMG border=0
				name=Image1
				src="./images/top_on.bmp"
				width=100 height=20></A><IMG src="" width=2>

				<A href="./cgi-bin/estseek.cgi"><IMG border=0
				name=Image2
				src="./images/solution_off.bmp" 
				width=100 height=20></A><IMG src="" width=2>
				
				<A href="./solution/products.php"><IMG border=0 
				name=Image3
				src="./images/kisyu_off.bmp" 
				width=100 height=20></A><IMG src="" width=2>

			<TD vAlign=bottom align=right><A 
				href="./solution/login.php"><IMG border=0 
				name=Image5
				src="./images/kanri_off.bmp" 
				width=100 height=20></A>
			</TD>
			</TR>
		</table>
		<TABLE border=1 cellSpacing=0 borderColor=#8080ff cellPadding=0 width="100%">
    		<TD vAlign=top borderColor=#8080ff colSpan=2 align=left>
	</div>

	<div class="wrapper">

	<!-- ************** 左カラム ***************** -->

	<div class="body_left">
		<br><table><td align="center" width="160px" style="background-color: #8888ff">
				<font color="#ffffff"><b>カテゴリ選択</b></font></td></table><br>
		<form action="" method="GET">
		<select name="CatCbx">
		<?php
			if ( isset( $_GET["CatCbx"] ) ) {
				extract( $_GET, EXTR_OVERWRITE );
				if ( $CatCbx === "カテゴリ" ) {
					echo "<option value=\"カテゴリ\" selected>カテゴリ</option>";
				} else {
					echo "<option value=\"カテゴリ\">カテゴリ</option>";
				}
				if ( $CatCbx === "メーカー" ) {
					echo "<option value=\"メーカー\" selected>メーカー</option>";
				} else {
					echo "<option value=\"メーカー\">メーカー</option>";
				}
				if ( $CatCbx === "ブランド" ) {
					echo "<option value=\"ブランド\" selected>ブランド</option>";
				} else {
					echo "<option value=\"ブランド\">ブランド</option>";
				}
			} else {
				$CatCbx = "カテゴリ";
				echo "<option value=\"カテゴリ\" selected>カテゴリ</option>";
				echo "<option value=\"メーカー\">メーカー</option>";
				echo "<option value=\"ブランド\">ブランド</option>";
			}
		?>
		</select>
		<input type="submit" name="SelBtn" value="選択">
		</form>
		<?php
			
			if ( isset( $CatCbx ) ) {
			$cn = db_connect( "solution" );
			if ( $CatCbx === "カテゴリ" ) {
				$res = mysqli_query( $cn, "SELECT * FROM cat_sol_tbl GROUP BY cat_cat ORDER BY cat_cat ASC" );
				while( $row = mysqli_fetch_array( $res ) ) {
					extract ( $row );
					$res2 = mysqli_query( $cn, "SELECT * FROM cat_sol_tbl WHERE cat_cat = '$cat_cat'" );
					$cnt = mysqli_num_rows( $res2 ); 
					echo "<li><a href=\"./index2.php?&CatCbx=$CatCbx&param=$cat_cat\">$cat_cat($cnt)</a>";
				}
			} else if ( $CatCbx === "メーカー" ) {
				$res = mysqli_query( $cn, "SELECT * FROM maker_sol_tbl GROUP BY mak_maker ORDER BY mak_maker ASC" );
				while( $row = mysqli_fetch_array( $res ) ) {
					extract ( $row );
					$res2 = mysqli_query( $cn, "SELECT * FROM maker_sol_tbl WHERE mak_maker = '$mak_maker'" );
					$cnt = mysqli_num_rows( $res2 ); 
					echo "<li><a href=\"./index2.php?&CatCbx=$CatCbx&param=$mak_maker\">$mak_maker($cnt)</a>";
				}
			} else if ( $CatCbx === "ブランド" ) {
				$res = mysqli_query( $cn, "SELECT * FROM brand_sol_tbl GROUP BY bra_brand ORDER BY bra_brand ASC" );
				while( $row = mysqli_fetch_array( $res ) ) {
					extract ( $row );
					$res2 = mysqli_query( $cn, "SELECT * FROM brand_sol_tbl WHERE bra_brand = '$bra_brand'" );
					$cnt = mysqli_num_rows( $res2 ); 
					echo "<li><a href=\"./index2.php?&CatCbx=$CatCbx&param=$bra_brand\">$bra_brand($cnt)</a>";
				}
			}
			db_close( $cn );
			}
		?>
		
		
	</div>

	<!-- ****************** 中央カラム ******************** -->

		<div class="body_mid">
		
			<?php
				if ( isset( $_GET["param"] ) ) {
					$param = $_GET["param"];
					echo "<br><p style=\"margin-left:0px\">
							<table><td align=\"center\" width=\"560px\" style=\"background-color: #8888ff\">
								<font color=\"#ffffff\"><b>$CatCbx = $param のソリューション</b></font></td></p></table><br>";
					//	$_GET　がある場合　→　カテゴリのSolution表示
					$cn = db_connect( "solution" );
					if ( isset( $CatCbx ) && $CatCbx === "カテゴリ" ) {
						$res = mysqli_query( $cn, "SELECT * FROM cat_sol_tbl WHERE cat_cat = '$param'" );
						echo "<ul>";
						while ( $row = mysqli_fetch_array( $res ) ) {
							extract( $row );
							$res2 = mysqli_query( $cn, "SELECT * FROM solution_tbl WHERE s_id = '$cat_sid' ORDER BY s_update" );
							$row2 = mysqli_fetch_array( $res2 );
								extract( $row2, EXTR_OVERWRITE );
								$s_place = "./solution/".substr( $s_place, 3 );
								echo "<li><font color=\"#0000ff\"><a href=\"$s_place\">$s_id</a></font><br>$s_title<br><br>";
						}
						echo "</ul>";
					} else if ( isset( $CatCbx ) && $CatCbx === "メーカー" ) {
						$res = mysqli_query( $cn, "SELECT * FROM maker_sol_tbl WHERE mak_maker = '$param'" );
						echo "<ul>";
						while ( $row = mysqli_fetch_array( $res ) ) {
							extract( $row );
							$res2 = mysqli_query( $cn, "SELECT * FROM solution_tbl WHERE s_id = '$mak_sid' ORDER BY s_update" );
							$row2 = mysqli_fetch_array( $res2 );
								extract( $row2, EXTR_OVERWRITE );
								$s_place = "./solution/".substr( $s_place, 3 );
								echo "<li><font color=\"#0000ff\"><a href=\"$s_place\">$s_id</a></font><br>$s_title<br><br>";
						}
						echo "</ul>";
					} else if ( isset( $CatCbx ) && $CatCbx === "ブランド" ) {
						$res = mysqli_query( $cn, "SELECT * FROM brand_sol_tbl WHERE bra_brand = '$param'" );
						echo "<ul>";
						while ( $row = mysqli_fetch_array( $res ) ) {
							extract( $row );
							$res2 = mysqli_query( $cn, "SELECT * FROM solution_tbl WHERE s_id = '$bra_sid' ORDER BY s_update" );
							$row2 = mysqli_fetch_array( $res2 );
								extract( $row2, EXTR_OVERWRITE );
								$s_place = "./solution/".substr( $s_place, 3 );
								echo "<li><font color=\"#0000ff\"><a href=\"$s_place\">$s_id</a></font><br>$s_title<br><br>";
						}
						echo "</ul>";
					} else {
						echo "<br><b></b><br>";
	
					}
	
					db_close( $cn );
					
				} else {
					//	$_GET　が無い場合　→　初期表示（新着Solution　）
					$cn = db_connect( "solution" );
					echo "<BR><p style=\"margin-left: 0px\">
							<table><td align=\"center\" width=\"560px\" style=\"background-color: #8888ff\">
								<font color=\"#ffffff\"><b>新着ソリューション</b></font></td></p></table><br>";
					$res = mysqli_query( $cn, "SELECT * FROM solution_tbl Order By s_update DESC" );
					$i = 1;
					echo "<ul>";
					while ( $row = mysqli_fetch_array( $res ) ) {
						if ( $i > 20 ) {
							break;
						}
						extract( $row, EXTR_OVERWRITE );
						$s_place = "./solution/".substr( $s_place, 3 );
						echo "<li><a href=\"$s_place\">$s_title<br><font size=-1>$s_id</a>&nbsp;&nbsp;($s_update"."更新)</font><br><br>";
						$i++;
					}
					echo "</ul>";
					mysqli_free_result( $res );
					db_close( $cn );
				}
			?>
		</div>

		<!-- ******************** 右カラム ************************ -->

		<div class="body_right">
			<br><p style="margin-left:0px">
					<table><td align="center" width="160px" style="background-color: #8888ff">
						<font color="#ffffff"><b>アクセスランキング</b></font></td></p></table><br>
			<font size=-1>
			<?php
			$cn = db_connect( "solution" );
			$res = mysqli_query( $cn, "SELECT COUNT(*) AS ac_cnt, ac_sid FROM access_tbl GROUP BY ac_sid ORDER BY ac_cnt DESC" );
			$i = 1;
			echo "<ol>";
			while( $row = mysqli_fetch_array( $res ) ) {
				if ( $i > 20 ) {
					break;
				}
				extract( $row, EXTR_OVERWRITE );
				$res2 = mysqli_query( $cn, "SELECT * FROM solution_tbl WHERE s_id = '$ac_sid'" );
				$row2 = mysqli_fetch_array( $res2 );
				extract( $row2, EXTR_OVERWRITE );
				$s_place = "./solution/".substr( $s_place, 3 );
				echo "<li><a href=\"$s_place\">$s_title</a>$s_id&nbsp;($ac_cnt)<br><br>";
				
				$i++;
			}
			echo "</ol>";
			
			?>
			</font>
		</div>

	</div>

	<!-- ******************** フッタ ********************* -->

	<div class="footer">
		<?php
			include "./footer.php";
		?>
	</div>
</div>

</body>
</html>
