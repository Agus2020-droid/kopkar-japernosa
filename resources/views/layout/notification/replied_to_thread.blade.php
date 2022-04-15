<div class="pull-left">
</div>
<h4>
<strong>{{json_encode($notification->data['request']['name'])}}</strong>
    <small><i class="fa fa-clock-o"></i> {{Carbon\Carbon::parse($notification->created_at)->format("d M y")}}</small>
</h4>
<p>Pinjaman kredit baru</p>