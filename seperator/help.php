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
			<ol>
				<li>move separator's directory inside Q2A's directory (so you would have <em>Q2A.com/separator</em> or <em>Q2A.WP.com/separator</em> or <em>WP.com/Q2A/separator</em>)</li>
				<li>visit Separator's directory in your web browser.</li>
				<li>Click <strong>Start It!</strong> button.</li>
				<li>in your Q2A directory, open <strong>qa-config.php</strong> and remove this line:
				<pre>define('QA_WORDPRESS_INTEGRATE_PATH', 'PATH TO WORDPRESS DIRECTORY');</pre></li>
				<li>Visit your Q2A site & click on <strong>Repair Database</strong> button.</li>
			</ol>
		<hr>
		<blockquote>
			<p>If you wish to seperate Q2A's database from WP's database, you can make a backup from your Q2A database tables and restore them in a new database. then you can change database definitions in <em>qa-config.php</em> so your Q2A will use new database.</p>
			<p>then you can remove old Q2A tables from wordpress directory or if you wish you can completely remove WordPress itself.</p>
			<small><a href="http://towhidn.com">Towhid</a><cite title="Source"> - developer</cite></small>
		</blockquote>
		<p>
			<p>if you need support or you have any questions please start a topic in <a href="http://qa-themes.com/forums/">our Forum</a>. if you already are a paid customer of our services or you wish to hire us feel free to <a href="http://qa-themes.com/contact-us">contact us</a>.</p>
		</p>
		<hr>
      <div class="footer">
        <p>Created by <a href="http://qa-themes.com">QA-Themes.com</a></p>
      </div>

    </div> <!-- /container -->
</body></html>