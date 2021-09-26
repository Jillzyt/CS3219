<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>You're logged in! </p>
                    <button>Send an HTTP GET request to get payments and get the result back</button>
                    <p id="p1">Hello World!</p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $("button").click(function(){
            $.get("/api/v1/payments", function(data) {
                document.getElementById("p1").innerHTML = JSON.stringify(data);
            });
        });
        });
    </script>  
});
</x-app-layout>
