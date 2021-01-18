<table>
  <thead>
    <tr>
      <th>MENUS</th>
      <th>TABLES</th>
      <th>SERVEUR</th>
      <th>QUANTITE</th>
      <th>TOTAL</th>
      <th>TYPE</th>
      <th>ETAT</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($sales as $sale)
    <tr>
      <td>
       @foreach($sale->menus()->where("sale_id",$sale->id)->get() as $menu)
       <h5>
        {{ $menu->title }}
       </h5>
       <h5>
       {{ $menu->price }} DH
       </h5>
      @endforeach
     </td>
    <td>
    @foreach($sale->tables()->where("sale_id",$sale->id)->get() as $table)
     <h5>
      {{ $table->name }}
     </h5>
    @endforeach
      </td>
      <td>
        {{ $sale->servant->name}}
      </td>
      <td>
        {{ $sale->quantity}}
      </td>
      <td>
        {{ $sale->total_received}} DH
      </td>
      <td>
        {{ $sale->payment_type === "cash" ? "Espéce" : "Carte bancaire"}}
      </td>
      <td>
       {{ $sale->payment_status === "paid" ? "Payé" : "Impayé"}}
      </td>
       </tr>
      @endforeach
      <tr>
        <td colspan="5">
          Rapport de {{ $from }} à {{ $to }}
        </td>
        <td>
          {{ $total }} DH
        </td>
      </tr>
  </tbody>
</table>
