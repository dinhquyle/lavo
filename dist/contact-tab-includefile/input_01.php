<table class="tableContact" cellspacing="0">
  <tr>
    <th><em class="required">【必須】</em>会社名</th>
    <td>
      <input type="text" name="company" placeholder="例) ◯△×株式会社" class="validate[required]">
    </td>
  </tr>
  <tr>
    <th><em class="required">【必須】</em>担当者名</th>
    <td>
      <input type="text" name="nameuser" placeholder="例) 山田 太郎" class="validate[required]">
    </td>
  </tr>
  <tr>
    <th><em class="required">【必須】</em>電話番号</th>
    <td>
      <input type="text" name="tel" placeholder="例) 1234567" class="validate[required]">
    </td>
  </tr>
  <tr>
    <th><em class="required">【必須】</em>メールアドレス</th>
    <td>
      <input type="url" name="email" placeholder="例) XXXX@sample.co.jp" class="validate[required]">
    </td>
  </tr>
  <tr>
    <th><em class="required">【必須】</em>配布予定部数</th>
    <td id="radioarray01">
      <p class="pRadio"><input class="validate[required]" name="radio" value="まだ決まっていない" id="radio01" type="radio"> <label for="radio01">まだ決まっていない</label></p>
      <p class="pRadio"><input class="validate[required]" name="radio" value="20,000部" id="radio02" type="radio"> <label for="radio02">20,000部</label></p>
      <p class="pRadio"><input class="validate[required]" name="radio" value="10,000部" id="radio03" type="radio"> <label for="radio03">10,000部</label></p>
    </td>
  </tr>
  <tr>
    <th>【任意】配布物のサイズ</th>
    <td>
      <select name="select" id="">
        <option value="">選択してください</option>
        <option value="A3">A3</option>
        <option value="A4">A4</option>
        <option value="A5">A5</option>
        <option value="B3">B3</option>
        <option value="B4">B4</option>
        <option value="B5">B5</option>
        <option value="その他">その他</option>
        <option value="未定">未定</option>
      </select>
    </td>
  </tr>
  <tr>
    <th>【任意】ホームページのURL</th>
    <td>
      <input type="url" name="homepage" placeholder="例) XXXX@sample.co.jp" class="">
    </td>
  </tr>
  <tr>
    <th>【任意】お問い合わせ内容</th>
    <td>
      <textarea name="content" id="" cols="30" rows="10"></textarea>
    </td>
  </tr>
</table>