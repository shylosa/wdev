<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<?php

require_once 'classes/SiteCode.php';

$source = 'https://colorlib.com/etc/glint/index.html';

$site = new SiteCode();
$site->setAddress($source);

$html = $site->getSiteCode();

//Тег, который будем искать и оборачивать самого себя
$tag = 'div';

?>

<script>
  //Получаем исходный код сайта с экранированием спецсимволов
  let htmlSource = decodeURIComponent('<?php echo rawurlencode($html)?>');

  //Оборачиваем в произвольный тег, чтобы работать только с внутренней частью.
  // Иначе не вернётся полный код. Делаем из строки объект jQuery.
  let $html = $('<tag>' + htmlSource + '</tag>');

  let wrapTag = '<?php echo $tag;?>';
  let fullWrapTag ='<' + wrapTag + '></' + wrapTag + '>';

  //let $htmlSource = '<div>Привет</div><p>ну, вот</p> <meta>опять</meta> <div>снова</div>';

  //Делаем выборку нужных тегов и оборачиваем их в себя же.
  $html.find(wrapTag).wrap(function(){
    return fullWrapTag;
  });

  //Получаем из объекта jQuery код html
  let wrapCode = $html.html();

  console.log( wrapCode );

</script>