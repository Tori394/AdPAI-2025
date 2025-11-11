document.addEventListener("DOMContentLoaded", function() {
    const panZoom = svgPanZoom('#allSvg', {
        zoomEnabled: true,
        panEnabled: true,
        minZoom: 1,
        maxZoom: 5,
        fit: true,
        center: true,
        beforePan: function(oldPan, newPan) {
        const padding = 80;
        const sizes = this.getSizes();
        const zoom = this.getZoom();

        const maxWidthOffset = sizes.width - sizes.viewBox.width * zoom;
        const maxHeightOffset = sizes.height - sizes.viewBox.height * zoom + padding;
        const minPanX = sizes.width - (1500 * zoom);

        return {
            x: Math.min(padding, Math.max(newPan.x, Math.max(maxWidthOffset, minPanX))),
            y: Math.min(padding, Math.max(newPan.y, maxHeightOffset))
        };
    }

    });
});