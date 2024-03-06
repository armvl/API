<?php

$search = $search ?? '';
$type = $type ?? '';
$rows = $rows ?? [];

$this->title = $search;

?>

<form class="park1">
  <input type="text" class="search">
  <select class="type">
    <option value="num" selected>Госномер</option>
    <option value="vin">ВИН</option>
    <option value="bn">Номер кузова</option>
    <option value="ch">Шасси</option>
  </select>
  <button class="submit">Найти</button>
  <span>Парк 1</span>
</form>

<form class="park2">
  <input type="text" class="search">
  <select class="type">
    <option value="vin" selected>ВИН</option>
    <option value="bn">Номер кузова</option>
    <option value="ch">Шасси</option>
  </select>
  <button class="submit">Найти</button>
  <span>Парк 2</span>
</form>

<form class="park3">
  <input type="text" class="search">
  <select class="type">
    <option value="num" selected>Госномер</option>
  </select>
  <button class="submit">Найти</button>
  <span>Парк 3</span>
</form>

<form class="park4">
  <input type="text" class="search">
  <select class="type">
    <option value="num" selected>Госномер</option>
    <option value="vin">ВИН</option>
  </select>
  <button class="submit">Найти</button>
  <span>Парк 4</span>
</form>

<form class="fake">
  <input type="text" class="search">
  <select class="type">
    <option value="num" selected>Госномер</option>
    <option value="vin">ВИН</option>
    <option value="bn">Номер кузова</option>
    <option value="ch">Шасси</option>
  </select>
  <button class="submit">Найти</button>
  <span>Фейк база</span>
</form>

<style>
  * {
    font-family: Consolas, monospace;
  }
  td {
    padding: 1px 12px 1px 0;
    font-size: 14px;
    border-bottom: 1px dashed #aaa;
  }
  hr {
    margin: 15px 0;
  }
  form {
    margin: 0 5px 5px 0;
  }
  input, select {
    font-size: 14px;
    padding: 3px 6px;
  }
</style>

<script>
  $(() => {

    $('.submit').on('click', (e) => {
      e.preventDefault()

      const match = location.search.match(/client=([a-z0-9]{40})/)

      if ( ! match[1])
        return alert('Ключ не верен')

      const
        $target = $(e.target),
        $form = $target.closest('form'),
        search = $form.find('.search').val(),
        type = $form.find('option:selected').val(),
        base = $form.attr('class'),
        key = match[1]

      if ( ! type)
        return alert('Тип не выбран')

      if ( ! search)
        return alert('Номер пуст')

      $.ajax({
        method: 'GET',
        url: `/api/${base}/${type}/${search}?client=${key}`,
        dataType: 'json',
        error: (ev) => {
          alert('Внимание, ошибка!')
          console.log(ev)
        },
        success: (res) => {
          if ( ! res.success)
            return alert('Внимание!\n' + res.result.msg)

          out(res.result)
        },
        beforeSend: () => {
          if ($target.is('.process')) return false
          $target.addClass('process')
        },
        complete: () => {
          $target.removeClass('process')
        }
      })
    })

    function out(result) {
      let
        html = '',
        $out = $('.out'),
        $count = $('.count')

      for (let i = 0; i < result.length; i += 1) {
        for (let slug in result[i]) {
          if (result[i].hasOwnProperty(slug))
            html += `<tr><td>${slug}</td><td><b>${result[i][slug] !== null ? result[i][slug] : ''}</b></td></tr>`
        }

        html += '<tr><td colspan="2"><hr></td></tr>'
      }

      $count.html(result.length)
      $out.html(html)
    }
  })
</script>
<br>

Количество: <span class="count"></span>

<br>
<hr>
<br>

<table class="out"></table>