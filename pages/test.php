<script>
    show();
    var a = "Ali";
    var prom = new Promise(
        (resolve, reject) => {
            resolve([{
                    name: "Bilal",
                    age: 20
                },
                {
                    name: "Ahmed",
                    age: 18
                }
            ]);
        });
    // prom.then(
    //     resp => {
    //         console.log('My second name is ' + resp);
    //     }
    // );
    // setTimeout(() => {
    //     console.log('My first name is ' + a);
    // }, 0);
    // console.log(a);

    function show() {
        console.log('show');

    }

    $(document).ready(function() {
        var b1 = "Naqi1";

    });
    var myArray = [];
    $(document).ready(function() {
        var b2 = "Naqi2";
    });
</script>