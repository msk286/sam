jQuery(window).load(function() {
    jQuery('.imglist img').each(function() {
        jQuery(this).wrap('<div style="display:inline-block;width:' + this.width + 'px;height:' + this.height + 'px;">').clone().addClass('gotcolors').css('position', 'absolute').insertBefore(this);
        this.src = grayscale(this.src);
    }).animate({
        opacity: 1
    }, 500);
});

function grayscale(src) {
    var supportsCanvas = !!document.createElement('canvas').getContext;
    if (supportsCanvas) {
        var canvas = document.createElement('canvas'),
            context = canvas.getContext('2d'),
            imageData, px, length, i = 0,
            gray,
            img = new Image();

        img.src = src;
        canvas.width = img.width;
        canvas.height = img.height;
        context.drawImage(img, 0, 0);

        imageData = context.getImageData(0, 0, canvas.width, canvas.height);
        px = imageData.data;
        length = px.length;

        for (; i < length; i += 4) {
            gray = px[i] * .3 + px[i + 1] * .59 + px[i + 2] * .11;
            px[i] = px[i + 1] = px[i + 2] = gray;
        }

        context.putImageData(imageData, 0, 0);
        return canvas.toDataURL();
    } else {
        return src;
    }
}