function add_scrap(y)
{
	var orientation = Math.round(Math.random() % 2);
	var imnum = Math.round(Math.random() % 3) + 1;
	var im = "/skyscrappers/";
	var he = Math.round(Math.random(20) + 20);
	var wi = Math.round(Math.random(20) + 20);
	var styl = "width: " + wi + "%; height: " + he + "%; background-size: 100% 100%; position:absolute; margin-top: " + y + "; ";
	if(orientation)
	{
		im += "right";
		styl += "right: 0;"
	}
	else
	{
		im += "left";
		styl += "left: 0;"
	}
	im += imnum;
	im += ".png";
	styl += "background-image: url('" + im + "');";
	var img = document.createElement('div');
	img.style = styl 
	scrapholder.appendChild(img);
	console.log(styl);
};

function add_from(from)
{
	var a;
	for(a = from; a <= document.body.scrollHeight; a += 500)
	{
		add_scrap(a + Math.floor(Math.random(50)) - 25);
	}
	return document.body.scrollHeight;
}
