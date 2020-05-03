function favorite(self){
    var counter = 0;
    var file_name = self;
    var favorites = Cookies.get("favorites"); // cookie取得
    if (favorites === undefined){
        console.log("Cookie undefined");
        Cookies.set("favorites", JSON.stringify(["PS","PS","PS"]));
        favorites = Cookies.get("favorites"); // cookie取得
    }
    var favoriteList = JSON.parse(favorites);
    if (favorites.indexOf("\""+file_name+"\"") != -1) { // お気に入りの有無
        // お気に入り削除処理
        favoriteList.some(function(favorite){
            if (favorite === file_name){
                return true;
            }else{
               counter++;
            }
        });
        favoriteList.splice(counter,1);
        Cookies.set("favorites", JSON.stringify(favoriteList));
        document.getElementById(self+"+").setAttribute("src", "src/off_star.png");
    }else{
        // お気に入り追加処理
        favoriteList.push(self);
        Cookies.set("favorites", JSON.stringify(favoriteList));
        document.getElementById(self+"+").setAttribute("src", "src/on_star.png");
    }
}