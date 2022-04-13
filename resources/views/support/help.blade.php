<x-app-layout>


    <div class="text-center py-10 md:flex flex justify-center">
        <div class="w-full p-0 md:w-2/3 my-5">
            <h2 class="text-2xl font-semibold">Resources & User Guides</h2>
            <div class="w-full p-2 md:p-2">

                @include('support.slider-small',['question'=>"Navigation Menu",
                'answer'=>" <img src='/other/guides/nav-menu.png'>
            "])

                @include('support.slider-small',['question'=>"How  to add Purchase New Stock?",
               'answer'=>" Head over to your portfolio page and click “Buy New Stock” button. And then Open Purchase New Stock modal,  add  your ticker or company name in input field like AMZN, Amazon.com see below screen short.
                            <img src='/other/stock/new-stocks.png'>
                            User can get all the current data for this ticker And then save it.
           "])

                @include('support.slider-small',['question'=>"How to Sell the stock?",
               'answer'=>" Head over to your portfolio page and click “SELL” button in stock record what you have sell stock
                            <img src='/other/stock/sell-buttons.png'>
                           Open “Stock Sale” modal. In this modal add how many share you want to sell and what is the average price per share and then save it.
           "])

                @include('support.slider-small',['question'=>"How to Add Existing Stock?",
               'answer'=>" Head over to your portfolio page and click “Buy” button in stock record what you have buy stock
                            <img src='/other/stock/buy-buttons.png'>
                           Open “Buy Existing Stock” modal. In this modal add how many share you want to add and what is average price per share and then save it.
           "])

                @include('support.slider-small',['question'=>"How to show all the stock “Buy” or “Sell” transaction?",
               'answer'=>" Head over to your portfolio page and show the “Historical Trades” table
                            <img src='/other/stock/historicals.png'>

           "])

                @include('support.slider-small',['question'=>"How can I edit the stock data?",
               'answer'=>" Head over to your portfolio page and click “Edit” icon in stock record what you have edit stock
                            <img src='/other/stock/edit-icons.png'>
                            Open “Purchase New Stock” modal. In this modal edit stock data what you want and then save it.
           "])

                @include('support.slider-small',['question'=>"How to show stock ticker all the details?",
               'answer'=>" Head over to your portfolio page and show the stock data in main table click the particular stock company name and open “Company Detail” modal display all the detail of this stock
                            <img src='/other/stock/company-details.png'>
           "])

                @include('support.slider-small',['question'=>"How can create “New Account”",
               'answer'=>" Head over to your accounts page and click “Add New Account” button
                            <img src='/other/account/accounts.png'>
                           Open “New Account” modal. In this modal add required and then save it.
           "])

                @include('support.slider-small',['question'=>"Can I set account as default",
               'answer'=>" Yes, head over the accounts page>>show the record of the account, check the checkbox which you want to set as a default
                            <img src='/other/account/set-as-defaults.png'>
           "])

            </div>
        </div>
    </div>

    <script type="text/javascript">

        $('.question_link').on('click', function () {
            $(this).parent().find(".question_answer").slideToggle(200);
            $(this).toggleClass('text-blue-900');
            $(this).toggleClass('text-blue-500');
            $(this).toggleClass('border-solid');
            $(this).toggleClass('border-b');
        })
    </script>

</x-app-layout>
