@foreach($information as $ing)
    <div style="text-align: center"><h1>店铺名称:{{ $ing->shop_name }}</h1></div>
    <div style="text-align: center">是否品牌:{{ $ing->brand==1?'√':'×' }}</div>
    <div style="text-align: center">是否加入准时达:{{ $ing->on_time==1?'√':'×' }}</div>
    <div style="text-align: center">是否加入蜂鸟配送:{{ $ing->fengniao==1?'√':'×' }}</div>
    <div style="text-align: center">是否准时送到:{{ $ing->zhun==1?'√':'×' }}</div>
    <div style="text-align: center">是否保险:{{ $ing->bao==1?'√':'×' }}</div>
    <div style="text-align: center">是否有发票:{{ $ing->piao==1?'√':'×' }}</div>
    @endforeach