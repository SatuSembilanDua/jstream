<style>
	.postbody a{
		color: #fff;
	}
	.releases {
	    position: relative;
	    display: flex;
	    justify-content: space-between;
	    align-items: baseline;
	    border-bottom: 1px solid #312f40;
	    padding: 8px 15px;
	}
	.page {
	    color: #DDD;
	    padding: 15px;
	    line-height: 21px;
	}
	.listcustom.cp {
	    margin: -15px;
	    margin-top: 10px;
	    font-size: 14px;
	}
	.nav_apb {
	    margin: 0 15px;
	    margin-bottom: 5px;
	    text-align: center;
	}
	.nav_apb a {
	    background: #333;
		text-align: center;
	    display: inline-block;
	    padding: 8px 12px!important;
	    margin: 2px;
	    color: #FFF;
	    border-radius: 3px;
	}
	.clear {
	    clear: both;
	}

	.soralist span {
	    display: block;
	    padding: 0 15px;
	    padding-bottom: 5px;
	    border-bottom: 1px solid #312f40;
	}
	.soralist span a {
	    font-weight: 700;
	    font-size: 15px;
	}
	.soralist ul {
	    margin: 0;
	    overflow: hidden;
	    color: #767676;
	    padding: 15px;
	    font-weight: 400;
	    font-size: 14px;
	}
	.soralist ul li {
	    margin-left: 15px;
	    float: left;
	    line-height: 20px;
	    margin-bottom: 3px;
	    width: 47%;
	}
	.taxindex {
	    overflow: hidden;
	    list-style: none;
	    padding: 0;
	    margin: 0 -10px;
	    flex-wrap: wrap;
	    display: flex;
	}
	.taxindex li {
	    width: 25%;
	}
	.taxindex li a {
	    margin: 10px;
	    padding: .5rem 1rem;
	    display: block;
	    border-radius: .25rem;
	    background: #333!important;
	    color: #999;
	    font-weight: 500;
	}
	.taxindex li a span.name {
	    display: inline-block;
	    max-width: 70%;
	    white-space: nowrap;
	    overflow: hidden;
	    text-overflow: ellipsis;
	}

	.taxindex li a span.count {
	    float: right;
	    font-style: normal;
	    color: #727579;
	    font-weight: 400;
	}
	
	@media (min-width: 320px) and (max-width: 480px) {
		.taxindex li {
		    width: 50%;
		}
	}
</style>
<?php

	function get_page($url){
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($ch, CURLOPT_PROXY, null);

		$data = curl_exec($ch);
		$info = curl_getinfo($ch);
		$error = curl_error($ch);

		curl_close($ch);
		$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
		$list_pagin = [];
		$html = $dom->load($data, true, true);
		foreach ($html->find(".postbody") as $div) {
			echo $div;
		}
		
	}
	get_page(d_url($_GET['lk']));
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("a.series").each(function(i, v){
			var link = $(v).attr("href");
			$.get("func.php?e_url="+link, function(data, status){
			    //console.log("Data: " + data + "\nStatus: " + status);
				$(v).attr("href","index.php?page=vhen&b="+data);
			});
		});
		$(".taxindex>li>a").each(function(i, v){
			var link = $(v).attr("href");
			$.get("func.php?e_url="+link, function(data, status){
			    //console.log("Data: " + data + "\nStatus: " + status);
				$(v).attr("href","index.php?page=hento&g="+data);
			});
		});
	});
</script>