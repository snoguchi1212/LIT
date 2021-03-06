# LIT
<img src="https://raw.githubusercontent.com/snoguchi1212/LIT/images/LIT_logo.png" width="20%">

## 概要

個別指導塾で使うための成績管理システムです。

オーナー・講師・生徒がログインユーザーとして画面が切り替わるマルチログイン機能を備えています。

オーナーは, 生徒が登録した成績をすべて閲覧できます。
また, 生徒の成績をcsv賭してダウンロードすることも可能です。

講師は、自分が担当している生徒の成績だけを閲覧することが出来ます。

生徒は、自分の成績を登録し, 閲覧することが出来ます。
成績の登録は、動的に行うことができ、学校によって違うテストの数や名前にも対応できるようになっています。

## 使い方

1. オーナー側から講師・生徒を登録します.

   適切な形式のcsvを読み込むことで, 一度にたくさんのデータを追加することもできます.

2. 講師と担当している生徒の結び付けを行います.

3. 生徒と講師にパスワードを発行し、出力します

<img src="https://raw.githubusercontent.com/snoguchi1212/LIT/images/LIT_gif/index1.gif" width="100%">
<img src="https://raw.githubusercontent.com/snoguchi1212/LIT/images/LIT_gif/index2.gif" width="100%">
<img src="https://raw.githubusercontent.com/snoguchi1212/LIT/images/LIT_gif/create.gif" width="100%">
<img src="https://raw.githubusercontent.com/snoguchi1212/LIT/images/LIT_gif/edit.gif" width="100%">

## 使用技術

- PHP 8.0
- Laravel 8.0
- tailwind CSS 3.0.18
- Docker/DockerCompose
