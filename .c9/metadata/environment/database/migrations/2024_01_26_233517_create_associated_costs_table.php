{"filter":false,"title":"2024_01_26_233517_create_associated_costs_table.php","tooltip":"/database/migrations/2024_01_26_233517_create_associated_costs_table.php","ace":{"folds":[],"scrolltop":67.79999999999998,"scrollleft":0,"selection":{"start":{"row":17,"column":36},"end":{"row":17,"column":36},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"hash":"d44a74afb71faea69d69ad447cbb3ace0838c8cf","undoManager":{"mark":16,"position":16,"stack":[[{"start":{"row":13,"column":8},"end":{"row":16,"column":11},"action":"remove","lines":["Schema::create('associated_costs', function (Blueprint $table) {","            $table->id();","            $table->timestamps();","        });"],"id":2},{"start":{"row":13,"column":8},"end":{"row":22,"column":0},"action":"insert","lines":["Schema::create('associated_costs', function (Blueprint $table) {","    $table->increments('id');","    $table->integer('template');","    $table->string('description');","    $table->string('location_cell');","    $table->string('location_sheet');","    $table->string('value');","    $table->timestamps();","});",""]}],[{"start":{"row":14,"column":0},"end":{"row":14,"column":4},"action":"insert","lines":["    "],"id":3},{"start":{"row":15,"column":0},"end":{"row":15,"column":4},"action":"insert","lines":["    "]},{"start":{"row":16,"column":0},"end":{"row":16,"column":4},"action":"insert","lines":["    "]},{"start":{"row":17,"column":0},"end":{"row":17,"column":4},"action":"insert","lines":["    "]},{"start":{"row":18,"column":0},"end":{"row":18,"column":4},"action":"insert","lines":["    "]},{"start":{"row":19,"column":0},"end":{"row":19,"column":4},"action":"insert","lines":["    "]},{"start":{"row":20,"column":0},"end":{"row":20,"column":4},"action":"insert","lines":["    "]},{"start":{"row":21,"column":0},"end":{"row":21,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":14,"column":0},"end":{"row":14,"column":4},"action":"insert","lines":["    "],"id":4},{"start":{"row":15,"column":0},"end":{"row":15,"column":4},"action":"insert","lines":["    "]},{"start":{"row":16,"column":0},"end":{"row":16,"column":4},"action":"insert","lines":["    "]},{"start":{"row":17,"column":0},"end":{"row":17,"column":4},"action":"insert","lines":["    "]},{"start":{"row":18,"column":0},"end":{"row":18,"column":4},"action":"insert","lines":["    "]},{"start":{"row":19,"column":0},"end":{"row":19,"column":4},"action":"insert","lines":["    "]},{"start":{"row":20,"column":0},"end":{"row":20,"column":4},"action":"insert","lines":["    "]},{"start":{"row":21,"column":0},"end":{"row":21,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":13,"column":8},"end":{"row":14,"column":0},"action":"insert","lines":["",""],"id":5},{"start":{"row":14,"column":0},"end":{"row":14,"column":8},"action":"insert","lines":["        "]},{"start":{"row":14,"column":8},"end":{"row":15,"column":0},"action":"insert","lines":["",""]},{"start":{"row":15,"column":0},"end":{"row":15,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":13,"column":8},"end":{"row":13,"column":49},"action":"insert","lines":["Schema::dropIfExists('associated_costs');"],"id":6}],[{"start":{"row":17,"column":20},"end":{"row":17,"column":27},"action":"remove","lines":["integer"],"id":7},{"start":{"row":17,"column":20},"end":{"row":17,"column":21},"action":"insert","lines":["s"]},{"start":{"row":17,"column":21},"end":{"row":17,"column":22},"action":"insert","lines":["t"]},{"start":{"row":17,"column":22},"end":{"row":17,"column":23},"action":"insert","lines":["r"]},{"start":{"row":17,"column":23},"end":{"row":17,"column":24},"action":"insert","lines":["i"]},{"start":{"row":17,"column":24},"end":{"row":17,"column":25},"action":"insert","lines":["n"]},{"start":{"row":17,"column":25},"end":{"row":17,"column":26},"action":"insert","lines":["g"]}],[{"start":{"row":17,"column":35},"end":{"row":17,"column":36},"action":"remove","lines":["e"],"id":8}],[{"start":{"row":17,"column":35},"end":{"row":17,"column":36},"action":"insert","lines":["e"],"id":9}],[{"start":{"row":17,"column":35},"end":{"row":17,"column":36},"action":"remove","lines":["e"],"id":10},{"start":{"row":17,"column":34},"end":{"row":17,"column":35},"action":"remove","lines":["t"]},{"start":{"row":17,"column":33},"end":{"row":17,"column":34},"action":"remove","lines":["a"]},{"start":{"row":17,"column":32},"end":{"row":17,"column":33},"action":"remove","lines":["l"]},{"start":{"row":17,"column":31},"end":{"row":17,"column":32},"action":"remove","lines":["p"]},{"start":{"row":17,"column":30},"end":{"row":17,"column":31},"action":"remove","lines":["m"]},{"start":{"row":17,"column":29},"end":{"row":17,"column":30},"action":"remove","lines":["e"]},{"start":{"row":17,"column":28},"end":{"row":17,"column":29},"action":"remove","lines":["t"]}],[{"start":{"row":17,"column":28},"end":{"row":17,"column":29},"action":"insert","lines":["f"],"id":11},{"start":{"row":17,"column":29},"end":{"row":17,"column":30},"action":"insert","lines":["i"]},{"start":{"row":17,"column":30},"end":{"row":17,"column":31},"action":"insert","lines":["l"]},{"start":{"row":17,"column":31},"end":{"row":17,"column":32},"action":"insert","lines":["e"]}],[{"start":{"row":17,"column":31},"end":{"row":17,"column":32},"action":"remove","lines":["e"],"id":12},{"start":{"row":17,"column":30},"end":{"row":17,"column":31},"action":"remove","lines":["l"]},{"start":{"row":17,"column":29},"end":{"row":17,"column":30},"action":"remove","lines":["i"]},{"start":{"row":17,"column":28},"end":{"row":17,"column":29},"action":"remove","lines":["f"]}],[{"start":{"row":17,"column":28},"end":{"row":17,"column":29},"action":"insert","lines":["t"],"id":13},{"start":{"row":17,"column":29},"end":{"row":17,"column":30},"action":"insert","lines":["e"]},{"start":{"row":17,"column":30},"end":{"row":17,"column":31},"action":"insert","lines":["m"]},{"start":{"row":17,"column":31},"end":{"row":17,"column":32},"action":"insert","lines":["p"]}],[{"start":{"row":17,"column":31},"end":{"row":17,"column":32},"action":"remove","lines":["p"],"id":14},{"start":{"row":17,"column":30},"end":{"row":17,"column":31},"action":"remove","lines":["m"]},{"start":{"row":17,"column":29},"end":{"row":17,"column":30},"action":"remove","lines":["e"]}],[{"start":{"row":17,"column":29},"end":{"row":17,"column":30},"action":"insert","lines":["m"],"id":15},{"start":{"row":17,"column":30},"end":{"row":17,"column":31},"action":"insert","lines":["p"]},{"start":{"row":17,"column":31},"end":{"row":17,"column":32},"action":"insert","lines":["_"]}],[{"start":{"row":17,"column":32},"end":{"row":17,"column":33},"action":"insert","lines":["c"],"id":16},{"start":{"row":17,"column":33},"end":{"row":17,"column":34},"action":"insert","lines":["o"]},{"start":{"row":17,"column":34},"end":{"row":17,"column":35},"action":"insert","lines":["d"]},{"start":{"row":17,"column":35},"end":{"row":17,"column":36},"action":"insert","lines":["e"]}],[{"start":{"row":17,"column":35},"end":{"row":17,"column":36},"action":"remove","lines":["e"],"id":17},{"start":{"row":17,"column":34},"end":{"row":17,"column":35},"action":"remove","lines":["d"]},{"start":{"row":17,"column":33},"end":{"row":17,"column":34},"action":"remove","lines":["o"]},{"start":{"row":17,"column":32},"end":{"row":17,"column":33},"action":"remove","lines":["c"]},{"start":{"row":17,"column":31},"end":{"row":17,"column":32},"action":"remove","lines":["_"]},{"start":{"row":17,"column":30},"end":{"row":17,"column":31},"action":"remove","lines":["p"]},{"start":{"row":17,"column":29},"end":{"row":17,"column":30},"action":"remove","lines":["m"]},{"start":{"row":17,"column":28},"end":{"row":17,"column":29},"action":"remove","lines":["t"]}],[{"start":{"row":17,"column":28},"end":{"row":17,"column":29},"action":"insert","lines":["f"],"id":18},{"start":{"row":17,"column":29},"end":{"row":17,"column":30},"action":"insert","lines":["i"]},{"start":{"row":17,"column":30},"end":{"row":17,"column":31},"action":"insert","lines":["l"]},{"start":{"row":17,"column":31},"end":{"row":17,"column":32},"action":"insert","lines":["e"]},{"start":{"row":17,"column":32},"end":{"row":17,"column":33},"action":"insert","lines":["n"]},{"start":{"row":17,"column":33},"end":{"row":17,"column":34},"action":"insert","lines":["a"]},{"start":{"row":17,"column":34},"end":{"row":17,"column":35},"action":"insert","lines":["m"]},{"start":{"row":17,"column":35},"end":{"row":17,"column":36},"action":"insert","lines":["e"]}]]},"timestamp":1706315212432}