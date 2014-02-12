<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>WP-Q2A Seperator</title>
    <link href="separator/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 40px;
      }

      /* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 700px;
      }
      .container-narrow > hr {
        margin: 30px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 72px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }
    </style>
    <link href="separator/bootstrap-theme.min.css" rel="stylesheet">
  </head>

  <body>

    <div class="container-narrow">

      <div class="masthead">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="help.php">Help</a></li>
        </ul>
        <h3 class="muted"><a href="index.php">Q2A-WP Seperator</a></h3>
      </div>

      <hr>


<?php

if (array_key_exists('start_submit', $_POST)) {
	if (file_exists ('../qa-config.php')){
		require_once '../qa-config.php';
		require_once '../qa-include/qa-base.php';
		require_once QA_INCLUDE_DIR.'qa-app-users.php';
		require_once QA_INCLUDE_DIR.'qa-app-admin.php';
		require_once QA_INCLUDE_DIR.'qa-app-format.php';
		require_once QA_INCLUDE_DIR.'qa-db.php';
		require_once QA_INCLUDE_DIR.'qa-db-selects.php';
		require_once QA_INCLUDE_DIR.'qa-db-users.php';
		require_once QA_INCLUDE_DIR.'qa-util-string.php';

		require_once '/database.php';
		if (defined('DB_NAME')){	
			$wpdb=DB_NAME;
			echo '<p>wordpress DB name: '.DB_NAME.'</p>';
			echo '<p>Q2A DB name: '.QA_MYSQL_DATABASE.'</p>';
			echo '<hr>';
			echo '<p>Starting Seperation...</p>';
			echo '<p>Creating ' . QA_MYSQL_TABLE_PREFIX . 'users database table</p>'; // userid is not AUTO_INCREMENT so it will be added manually
				qa_db_query_sub("
					CREATE TABLE IF NOT EXISTS `" . QA_MYSQL_TABLE_PREFIX . "users` (
					`userid` int(10) unsigned NOT NULL,
					`created` datetime NOT NULL,
					`createip` int(10) unsigned NOT NULL,
					`email` varchar(80) NOT NULL,
					`handle` varchar(20) NOT NULL,
					`avatarblobid` bigint(20) unsigned DEFAULT NULL,
					`avatarwidth` smallint(5) unsigned DEFAULT NULL,
					`avatarheight` smallint(5) unsigned DEFAULT NULL,
					`passsalt` binary(16) DEFAULT NULL,
					`passcheck` binary(20) DEFAULT NULL,
					`level` tinyint(3) unsigned NOT NULL,
					`loggedin` datetime NOT NULL,
					`loginip` int(10) unsigned NOT NULL,
					`written` datetime DEFAULT NULL,
					`writeip` int(10) unsigned DEFAULT NULL,
					`emailcode` char(8) CHARACTER SET ascii NOT NULL DEFAULT '',
					`sessioncode` char(8) CHARACTER SET ascii NOT NULL DEFAULT '',
					`sessionsource` varchar(16) CHARACTER SET ascii DEFAULT '',
					`flags` tinyint(3) unsigned NOT NULL DEFAULT '0',
					PRIMARY KEY (`userid`),
					KEY `email` (`email`),
					KEY `handle` (`handle`),
					KEY `level` (`level`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
				");
				echo '<p>Creating ' . QA_MYSQL_TABLE_PREFIX . 'messages database table</p>';
				qa_db_query_sub("
					CREATE TABLE IF NOT EXISTS `" . QA_MYSQL_TABLE_PREFIX . "messages` (
						`messageid` int(10) unsigned NOT NULL AUTO_INCREMENT,
						`type` enum('PUBLIC','PRIVATE') NOT NULL DEFAULT 'PRIVATE',
						`fromuserid` int(10) unsigned NOT NULL,
						`touserid` int(10) unsigned NOT NULL,
						`content` varchar(8000) NOT NULL,
						`format` varchar(20) CHARACTER SET ascii NOT NULL,
						`created` datetime NOT NULL,
						PRIMARY KEY (`messageid`),
						KEY `type` (`type`,`fromuserid`,`touserid`,`created`),
						KEY `touserid` (`touserid`,`type`,`created`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
				");	
				echo '<p>Creating ' . QA_MYSQL_TABLE_PREFIX . 'userfields database table</p>';
				qa_db_query_sub("
					CREATE TABLE IF NOT EXISTS `" . QA_MYSQL_TABLE_PREFIX . "userfields` (
						`fieldid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
						`title` varchar(40) NOT NULL,
						`content` varchar(40) DEFAULT NULL,
						`position` smallint(5) unsigned NOT NULL,
						`flags` tinyint(3) unsigned NOT NULL,
						`permit` tinyint(3) unsigned DEFAULT NULL,
						PRIMARY KEY (`fieldid`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
				");	
				echo '<p>Creating ' . QA_MYSQL_TABLE_PREFIX . 'userlogins database table</p>';
				qa_db_query_sub("
					CREATE TABLE IF NOT EXISTS `" . QA_MYSQL_TABLE_PREFIX . "userlogins` (
						`userid` int(10) unsigned NOT NULL,
						`source` varchar(16) CHARACTER SET ascii NOT NULL,
						`identifier` varbinary(1024) NOT NULL,
						`identifiermd5` binary(16) NOT NULL,
						KEY `source` (`source`,`identifiermd5`),
						KEY `userid` (`userid`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;
				");	
				echo '<p>Creating ' . QA_MYSQL_TABLE_PREFIX . 'userprofile database table</p>';
				qa_db_query_sub("
					CREATE TABLE IF NOT EXISTS `" . QA_MYSQL_TABLE_PREFIX . "userprofile` (
						`userid` int(10) unsigned NOT NULL,
						`title` varchar(40) NOT NULL,
						`content` varchar(8000) NOT NULL,
						UNIQUE KEY `userid` (`userid`,`title`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;
				");	
				
				echo '<p>Creating userprofile table\'s fields</p>';
				qa_db_query_sub("
					INSERT INTO `" . QA_MYSQL_TABLE_PREFIX . "userfields` (`fieldid`, `title`, `content`, `position`, `flags`, `permit`) VALUES
						(1, 'name', NULL, 1, 0, NULL),
						(2, 'location', NULL, 2, 0, NULL),
						(3, 'website', NULL, 3, 2, NULL),
						(4, 'about', NULL, 4, 1, NULL);
				");	
				
				/*
				echo '<p>Creating Constraints</p>';
				//Constraints for table `qa_userlogins`
				qa_db_query_sub("
					ALTER TABLE `" . QA_MYSQL_TABLE_PREFIX . "userlogins`
					  ADD CONSTRAINT `" . QA_MYSQL_TABLE_PREFIX . "userlogins_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `" . QA_MYSQL_TABLE_PREFIX . "users` (`userid`) ON DELETE CASCADE;
				");
				//Constraints for table `qa_userprofile`
				qa_db_query_sub("
					ALTER TABLE `" . QA_MYSQL_TABLE_PREFIX . "userprofile`
						ADD CONSTRAINT `" . QA_MYSQL_TABLE_PREFIX . "userprofile_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `" . QA_MYSQL_TABLE_PREFIX . "users` (`userid`) ON DELETE CASCADE;
				");
				*/
				echo '</br><p>Starting importing users</p>';
				$db=new database;
				$result=$db->query("SELECT * FROM " . $table_prefix. "users");
				$count=$db->numRows();
				echo '<div class="alert alert-info">importing '.$count.' users</div>';
				//$results=$db->fetchArray($result);
				?>
				<div id="accordion2" class="accordion">
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" href="#collapseOne" data-parent="#accordion2" data-toggle="collapse"> List of users which had been added </a>
						</div>
						<div id="collapseOne" class="accordion-body collapse" style="height: 0px;">
							<div class="accordion-inner">
				<?php 
				while($row = $db->fetchArray($result))
				{
					//var_dump($row);
					$id=$row['ID'];
					$handle=trim($row['user_login']);
					$password='123';//trim($row['user_pass']);
					$email=trim($row['user_email']);
					$created=trim($row['user_registered']);
					$site=trim($row['user_url']); if (empty($site)) $site='';
					$name=trim($row['display_name']);if (empty($name)) $name='';
					$result2=$db->query("SELECT * FROM " . $table_prefix. "usermeta WHERE user_id='". $id ."' AND meta_key='wp_user_level'");
					$results2=$db->fetchArray($result2);
					$userlevel=$results2['meta_value'];
					if ($userlevel>=10)
						$level=QA_USER_LEVEL_ADMIN;
					elseif ($userlevel>=7)
						$level=QA_USER_LEVEL_EDITOR;
					elseif ($userlevel>=1)
						$level=QA_USER_LEVEL_EXPERT;
					else
						$level=QA_USER_LEVEL_BASIC;
					
					$ip = '192.168.0.0';
					$result3=$db->query("SELECT * FROM " . $table_prefix. "usermeta WHERE user_id='". $id ."' AND meta_key='description'");echo "SELECT * FROM " . $table_prefix. "usermeta WHERE user_id='". $id ."' AND meta_key='description'";
					$results3=$db->fetchArray($result3);
					$bio=$results3['meta_value']; if (empty($bio)) $bio='';

					echo 'username: ' . $handle . ' - email: ' . $email . ' - userlevel: ' . $level . ' - bio: ' . $bio . '</br>';
					
					// Adding user to database: qa_db_user_create($email, $password, $handle, $level, '192.168.0.0');
					$salt=isset($password) ? qa_random_alphanum(16) : null;
					qa_db_query_sub(
						'INSERT INTO `^users` (userid,created, createip, email, passsalt, passcheck,  level, handle, loggedin, loginip) '.
						'VALUES ($, $, COALESCE(INET_ATON($), 0), $, $, UNHEX($), #, $, NOW(), COALESCE(INET_ATON($), 0))',
						$id ,$created , $ip, $email, $salt, isset($password) ? qa_db_calc_passcheck($password, $salt) : null, (int)$level, $handle, $ip
					);
					qa_db_query_sub(
						'INSERT INTO ^userprofile (userid,title, content) '.
						'VALUES ($,$,$)',
						$id,'about' ,$bio
					);
					qa_db_query_sub(
						'INSERT INTO ^userprofile (userid,title, content) '.
						'VALUES ($,$,$)',
						$id,'name' ,$name
					);
					qa_db_query_sub(
						'INSERT INTO ^userprofile (userid,title, content) '.
						'VALUES ($,$,$)',
						$id,'website' ,$site
					);
				}
				qa_db_query_sub( "ALTER TABLE `^users` CHANGE `userid` `userid` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT");
				?>			</div>
						</div>
					</div>
				</div>
			<?php
		}else{
			echo '<div class="alert alert-danger">Could not find Q2A-WP integration.</div>';
		}
	}else{
		echo '<div class="alert alert-danger">Could not find Q2A\'s installation.</div>';
	}
} else {
	echo '
    <div class="jumbotron">
		<h3>Seperate Q2A from it\'s WordPress Integration</h3></br>
		<p><span class="label label-danger">Danger</span> Always make a full backup of your site before separation.</p>
		<span><span class="label label-warning">Warning</span> This Code is released with no guarantees. if you are not a web developer, you might need to hire a developer to handle this process.</span>
		<br><br><form action="index.php" method="post">
		<input type="hidden" name="start_submit" value="1" />
		<input class="btn btn-primary btn-large" type="submit" value="Start It!">
		</form>
    </div>
	';
}
?>

      <hr>

      <div class="footer">
        <p>Created by <a href="http://qa-themes.com">QA-Themes.com</a></p>
      </div>

    </div> <!-- /container -->
</body></html>