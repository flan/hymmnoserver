<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>HYMMNOSERVER - Main</title>
		<?php include 'common/resources.xml'; ?>
	</head>
	<body>
		<?php include 'common/header.xml'; ?>
		<?php
			$page = $_GET['page'];
			if($page == NULL || $page == ''){
				$page = 'a';
			}else{
				$page = strtolower($page[0]);
			}
			
			$page_ord = ord($page);
			if($page_ord < 97 || $page_ord > 122){
				$page = 'a';
			}
			
			for($i = 97; $i <= 122; $i++){
				$chr_i = chr($i);
				
				echo "<a href=\"/hymmnoserver/browse.php?page=$chr_i\">";
				
				$current_page = $i == $page_ord;
				if($current_page){
					echo "<span style=\"font-weight: bold; font-size: 1.5em;\">$chr_i</span>";
				}else{
					echo $chr_i;
				}
				
				echo '</a>';
				
				if($i != 122){
					echo " / ";
				}
			}
		?>
		<hr/>
		<span style="color: red;">
			<?php
				/*
				//Connect to the database and grab records.
				
				echo '<b>$count records found</b><br/>';
				*/
			?>
			Hymmnos entries will open in a new window
		</span>
		<br/><br/>
		<table>
			<tr>
				<th class="result-header" style="width: 100px;">Hymmnos</td>
				<th class="result-header" style="width: 170px;">Meaning</td>
				<th class="result-header" style="width: 150px;">Japanese</td>
				<th class="result-header" style="width: 240px;">School</td>
			</tr>
			<?php
				/*
				List every entry found in the database.
				*/
				
				echo "<tr><td colspan=\"4\" style=\"color: red; font-weight: bold; text-align: center;\">No matches found</td></tr>";
			?>
		</table>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
