<?php
  require_once 'tcpdf/tcpdf.php'; // Подключаем библиотеку
  /* Создаём объект TCPDF.
  - Книжная ориентация
  - Единица измерения - миллиметры
  - Формат А4
  - Использование unicode
  - Кодировка - UTF-8
  */
  $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8',false);
  /* Установка отступов
  - 20 слева
  - 30 справа
  - 20 сверху
  */
  $pdf->setFont('freeserif','',12);
  $pdf->SetMargins(20, 30, 20);
  $pdf->AddPage(); // Добавляем страницу
  $pdf->SetXY(20, 50); // Установка текущей точки (в мм)
  //$pdf->SetDrawColor(100, 100, 0); // Установка цвета (RGB)
  //$pdf->SetTextColor(200, 0, 0); // Установка цвета текста (RGB)
  /* Выводим надпись.
  - Ширина 30 мм
  - Высота 10 мм
  - Текст "Hello, World"
  */
  
  $html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
  h1 {
    color: navy;
    font-size: 24pt;
    text-decoration: underline;
  }
  p {
    color: red;
    font-size: 12pt;
  }
</style>
<body>
<h1>Example of <i>HTML + CSS</i></h1>
<p>Тестовый текст</p>
</body>
EOF;
  //$ww = iconv('windows-1251', 'UTF-8', $tt);
  $pdf->writeHTML($html, true, false, true, false, '');
  //$pdf->Cell(30, 10, $tt);
  $pdf->Output('test.pdf'); // Выводим в браузер
?>