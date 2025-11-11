document.addEventListener("DOMContentLoaded", function() {
    const panZoom = svgPanZoom('#allSvg', {
        zoomEnabled: true,
        panEnabled: true,
        minZoom: 1,
        maxZoom: 5,
        fit: true,
        center: true,
        beforePan: function(oldPan, newPan) {
        const paddingTop = 100;
        const sizes = this.getSizes();
        const zoom = this.getZoom();

        const SVGWidth = sizes.viewBox.width;
        const SVGHeight = sizes.viewBox.height;
        const viewerWidth = sizes.width;
        const viewerHeight = sizes.height;

        const onScreenWidth = SVGWidth * zoom;
        const onScreenHeight = SVGHeight * zoom;

        const maxWidthOffset = viewerWidth - onScreenWidth;
        const maxHeightOffset = viewerHeight - onScreenHeight + paddingTop;

        return {
            x: Math.min(paddingTop, Math.max(newPan.x, maxWidthOffset)),
            y: Math.min(paddingTop, Math.max(newPan.y, maxHeightOffset))
        };
    }

    });
});