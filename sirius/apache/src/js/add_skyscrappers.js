function add_scrap(y) {
    var orientation = Math.round(Math.random() % 2);
    var imnum = Math.round(Math.random() % 3) + 1;
    var im = "/images/skyscrappers/";
    var he = 20;//Math.round(Math.random(20) + 20);
    var wi = he;
    var styl = "z-index: -9000; width: " + wi + "%; height: " + he + "%; background-size: 100%; position:absolute; margin-top: " + y + "px; ";
    if (orientation) {
        im += "right";
        styl += "right: 0;"
    } else {
        im += "left";
        styl += "left: 0;"
    }
    im += imnum;
    im += ".png";
    styl += "background-image: url('" + im + "');";
    var img = document.createElement('div');
    img.style = styl
    scrapholder.appendChild(img);
};

function cycled_scrap(y) {
	var img = document.createElement('div');
	img.style = "z-index: -9000; width: 10%; height: 10%; left:0; background-size: 100%; position:absolute; margin-top: " + y + "px; background-image: url('/images/skyscrappers/cycled.png');";
	scrapholder.appendChild(img);
};

function add_from(from) {
    var a;
    for (a = from; a <= document.body.scrollHeight; a += 70) {
        cycled_scrap(a);
    }
    return document.body.scrollHeight;
};
