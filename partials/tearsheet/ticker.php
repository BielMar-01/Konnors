<?php 
    global $sectionIndex;

    $title = get_sub_field("title");
    $ticker = get_sub_field("ticker");
    $currency = get_sub_field("currency");
    $market = get_sub_field("market");
?>
<section class="wpContent--ticker">
    <h2><?php echo $title; ?></h2>
    <table index="<?php echo $sectionIndex ?>" class="tickerData">
        <thead>
            <tr>
                <th class="price"></th>
                <th class="variation"></th>
            </tr>
        </thead>
        <tbody>
            <tr class="market">
                <td><?php _e("Market", LANG_DOMAIN); ?></td>
                <td class="value"><?php echo $market; ?></td>
            </tr>
            <tr class="symbol">
                <td><?php _e("Symbol", LANG_DOMAIN); ?></td>
                <td class="value"><?php echo $ticker; ?></td>
            </tr>

            <tr class="shares">
                <td><?php _e("Number of shares", LANG_DOMAIN); ?></td>
                <td class="value"></td>
            </tr>
            <tr class="marketCap">
                <td><?php _e("Market Cap", LANG_DOMAIN); ?></td>
                <td class="value"></td>
            </tr>
        </tbody>
    </table>
    <script>
        const symbol = "<?php echo $ticker; ?>";
        const currency = "<?php echo $currency; ?>";

        function updatePrices(){
            let tickerBlock = document.querySelector('.tickerData[index="<?php echo $sectionIndex ?>"]');
            let ajax = new XMLHttpRequest();
            ajax.open("GET", "https://apicatalog.mziq.com/stockinfo/"+ stockInfoId +"/live");
            ajax.onreadystatechange = function(e){
                // console.log(ajax.readyState, ajax.status, e.target.response);
                if (ajax.readyState == 4) {
                    if (ajax.status == 200) {
                        console.log('done');
                        let data = JSON.parse(e.target.response).data;
                        let ticker = data.tickers.filter(function(item){
                            return item.ticker === symbol;
                        })[0];

                        console.log(ticker);

                        let price = ticker.info.price.toLocaleString(lang, {minimumFractionDigits: 2});
                        let variation = ticker.info.var.toLocaleString(lang, {minimumFractionDigits: 2}) +"%";
                        let shares = ticker.info.share.toLocaleString(lang, {maximumFractionDigits: 0});
                        let marketCap = ticker.info.marketCap.toLocaleString(lang, {maximumFractionDigits: 0});

                        tickerBlock.querySelector("th.price").innerHTML = price +" "+ currency;
                        tickerBlock.querySelector("th.variation").innerHTML = "<span>"+ variation +"</span>";
                        
                        tickerBlock.querySelector("tr.shares td.value").innerHTML = shares;
                        tickerBlock.querySelector("tr.marketCap td.value").innerHTML = marketCap;
                    }
                }
            }
            ajax.send();
        }

        updatePrices();
        setInterval(updatePrices, 60*1000);
    </script>
</section>