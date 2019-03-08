﻿if (!window.LChart) {
    throw new Error('未能加载loongchart.core.js，该js必须在其他LChart框架的js加载之前被引用。\n' +
      'Not loaded loongchart.core.js which must be loaded before other LChart\'s js.');
}
else {
    LChart.Const.Skins.BlackAndWhite.Ring3D = {
        SeparateLineColor: null,
        InnerLabelColor: null,
        OuterLabelColor: null,
        OuterLabelBorderColor: null,
        OuterLabelBackColor: 'rgba(255,255,255,0.3)'
    };
}
LChart.Ring3D = LChart.getCore().__extends({ GraphType: 'Ring3D' });
LChart.Ring3D._spreadSkin = function (newOps, skin) {
    newOps.separateLine = {}; newOps.innerLabel = {}; newOps.outerLabel = {};
    newOps.separateLine.color = skin.SeparateLineColor || null;
    newOps.innerLabel.color = skin.InnerLabelColor || null;
    newOps.outerLabel.color = skin.OuterLabelColor || null;
    newOps.outerLabel.bordercolor = skin.OuterLabelBorderColor || null;
    newOps.outerLabel.backcolor = skin.OuterLabelBackColor || null;
};
LChart.Ring3D._getDefaultOptions = function (originalCommonOptions) {
    var options = LChart.Methods.Extend(originalCommonOptions, {
        offX: 0,
        offY: 0,
        innerRadius: null,
        outerRadius: null,
        margin: null,
        colors: null,
        animateRotate: true,
        animateScale: true,
        startAngle: null,
        clickout: true,
        reflection3d: {
            reflectoffX: null,
            reflectoffY: null,
            zoomX: null,
            zoomY: null
        },
        separateLine: {
            show: false,
            color: null,
            width: null
        },
        innerLabel: {
            show: true,
            content: function (data) {
                return data.percent.toFixed(1) + '%';
            },
            distance: null,
            color: null,
            fontsize: null,
            fontfamily: null
        },
        outerLabel: {
            show: true,
            content: function (data) {
                return data.text + ' ' + data.percent.toFixed(1) + '%';
            },
            withlegend: true,
            legendtype: null,
            length: null,
            color: null,
            backcolor: 'rgba(255,255,255,0.3)',
            bordercolor: null,
            borderwidth: 0.5,
            fontsize: null,
            fontfamily: null
        }
    });
    return options;
};
LChart.Ring3D._getCheckOptions = function () {
    return {
        __top: [['offX', 'n'], ['offY', 'n'], ['innerRadius', 'n'], ['outerRadius', 'n'], ['margin', 'n'], ['colors', 'ca'], ['animateRotate', 'b'], ['animateScale', 'b'], ['startAngle', 'n'], ['clickout', 'b']],
        reflection3d: [['reflectoffX', 'n'], ['reflectoffY', 'n'], ['zoomX', 'n'], ['zoomY', 'n']],
        separateLine: [['show', 'b'], ['color', 'c'], ['width', 'n']],
        innerLabel: [['show', 'b'], ['content', 'f'], ['distance', 'n'], ['color', 'c'], ['fontsize', 'n'], ['fontfamily', 's']],
        outerLabel: [['show', 'b'], ['content', 'f'], ['withlegend', 'b'], ['legendtype', 's'], ['length', 'n'], ['backcolor', 'c'], ['bordercolor', 'c'], ['borderwidth', 'n'], ['color', 'c'], ['fontsize', 'n'], ['fontfamily', 's']]
    };
};
LChart.Ring3D._drawgraphic = function (inner, graphicID, innerData, options) {
    var segmentTotal = inner._computeSegmentTotal(innerData).segmentTotal;
    var cutX = 3; var cutY = 3;
    var zoomX = options.reflection3d.zoomX || 1.2;
    var zoomY = options.reflection3d.zoomY || 0.9;
    if (inner._configs._isIE678.isIE678) {
        zoomX = 1; zoomY = 1;
    }
    var radiusInfo = inner._computeRadiusForPies(options, zoomX, zoomY);
    if (inner._configs._isIE678.isIE678) {
        radiusInfo.maxRadius *= 0.9;
    }
    var pieOuterRadius = !options.outerRadius || !LChart.Methods.IsNumber(options.outerRadius) ? radiusInfo.maxRadius : options.outerRadius;
    var pieInnerRadius = options.innerRadius && options.innerRadius > pieOuterRadius * 0.1 && options.innerRadius < pieOuterRadius ? options.innerRadius : pieOuterRadius * 0.7;
    if (pieOuterRadius <= pieInnerRadius) {
        throw new Error(inner._messages.WrongSet + inner._messages.OuterRadiusShouldBigger);
    }
    var clickoutLength = pieOuterRadius / 10;
    var isMain = graphicID == inner.ID;
    var colors = (options.colors && options.colors.length > 0 ? options.colors : null) || LChart.Const.Defaults.FillColors;
    if (isMain) {
        inner.coordinates.draw = radiusInfo.coordinate;
        inner._configs.legendColors = colors;
    }
    inner.shapes[graphicID] = { cemicircles: [], outerLabels: [], faces: null };
    var shapes = inner.shapes[graphicID];
    if (!inner.coordinates.ring) { inner.coordinates.ring = {}; }
    inner.coordinates.ring[graphicID] = { outerRadius: pieOuterRadius, innerRadius: pieInnerRadius, centerX: radiusInfo.centerX, centerY: radiusInfo.centerY, cemicircles: [], outerlabels: [] };

    var reflectoffX = options.reflection3d.reflectoffX || 0;
    var reflectoffY = options.reflection3d.reflectoffY || pieOuterRadius / 6;
    var resetOuterLabelPosition = true;
    var specificConfig = inner._configs.specificConfig[graphicID];
    var linewidth = options.separateLine.show ? (options.separateLine.width || 1) : 0;
    var linecolor = options.separateLine.color || '#ffffff';
    var initialStartAngle = Math.PI * (options.startAngle == null ? -0.5 : options.startAngle);
    var reflectAngle = inner._getReflectAngle(reflectoffX, reflectoffY);

    var computeSemicircle = function (clickout, scalePercent, angleMin, angleMax) {
        var midAngle = (angleMin + angleMax) / 2;
        var centerX = radiusInfo.centerX;
        var centerY = radiusInfo.centerY;
        var cosmid = Math.cos(midAngle);
        var sinmid = Math.sin(midAngle);
        if (clickout) {
            centerX += clickoutLength * cosmid;
            centerY += clickoutLength * sinmid;
        }
        var innerRadius = pieInnerRadius * scalePercent;
        var outerRadius = pieOuterRadius * scalePercent;
        var darkCenterX = centerX + reflectoffX;
        var darkCenterY = centerY + reflectoffY;

        var computeLoc = function (centertype, angletype, radiustype) {
            var centerNum = centertype == 0 ? centerX : (centertype == 1 ? centerY : (centertype == 2 ? darkCenterX : darkCenterY));
            var sincos = centertype == 0 || centertype == 2 ? Math.cos : Math.sin;
            return centerNum + sincos(angletype ? angleMax : angleMin) * (radiustype ? outerRadius : innerRadius);
        };

        return {
            angleMin: angleMin, angleMax: angleMax, midAngle: midAngle, centerX: centerX, centerY: centerY, darkCenterX: darkCenterX, darkCenterY: darkCenterY, innerRadius: innerRadius, outerRadius: outerRadius,
            iStartX: computeLoc(0, 0, 0), iStartY: computeLoc(1, 0, 0), iEndX: computeLoc(0, 1, 0), iEndY: computeLoc(1, 1, 0),
            oStartX: computeLoc(0, 0, 1), oStartY: computeLoc(1, 0, 1), oEndX: computeLoc(0, 1, 1), oEndY: computeLoc(1, 1, 1),
            d_iStartX: computeLoc(2, 0, 0), d_iStartY: computeLoc(3, 0, 0), d_iEndX: computeLoc(2, 1, 0), d_iEndY: computeLoc(3, 1, 0),
            d_oStartX: computeLoc(2, 0, 1), d_oStartY: computeLoc(3, 0, 1), d_oEndX: computeLoc(2, 1, 1), d_oEndY: computeLoc(3, 1, 1)
        };
    };
    var judgeAngleAtSight = function (angle) {
        return LChart.Methods.computeDifferAngle(angle, reflectAngle * Math.PI) < Math.PI / 2;
    };
    var outerLabelShape = function (content, length, width, height, floatright, floattop, data, contact) {
        this.content = content;
        this.length = length;
        this.width = width;
        this.height = height;
        this.floatright = floatright;
        this.floattop = floattop;
        this.data = data;
        this.contact = contact;
        this.color = this.contact.color;
        this.index = this.contact.index;
        this.resetposition = function () {
            var computeinfo = this.contact.computeinfo(), drawAtDark = judgeAngleAtSight(computeinfo.midAngle);
            var distance = 1.15, cosmid = Math.cos(computeinfo.midAngle), sinmid = Math.sin(computeinfo.midAngle), sinbottom = sinmid > 0 ? sinmid : 0;
            this.startX = (drawAtDark ? (computeinfo.centerX + computeinfo.darkCenterX) / 2 : computeinfo.centerX) + pieOuterRadius * cosmid;
            this.startY = (drawAtDark ? (computeinfo.centerY + computeinfo.darkCenterY) / 2 : computeinfo.centerY) + pieOuterRadius * sinmid;
            this.left = (drawAtDark ? computeinfo.darkCenterX : computeinfo.centerX) + pieOuterRadius * distance * cosmid + (this.floatright ? 0 : -this.width);
            this.top = (drawAtDark ? computeinfo.darkCenterY : computeinfo.centerY) + pieOuterRadius * distance * sinmid + sinbottom * this.length - this.length - cutY;
        };
        this.endX = function () { return this.left + (this.floatright ? 0 : this.width); };
        this.endY = function () { return this.top + this.height / 2; };
    };

    var pieshape = function (index, color, percent, angleMin, angleMax, midAngle, data, isClickout) {
        this.index = index;
        this.color = color;
        this.percent = percent;
        this.angleMin = angleMin;
        this.angleMax = angleMax;
        this.midAngle = midAngle;
        this.isHovered = false;
        this.isClickout = isClickout;
        this.data = data;
        this.redraw = function (clickout, color) {
            var mouseon = color;
            for (var i = 0; i < 4; i++) {
                drawPart(i, clickout, 1, this.angleMin, this.angleMax, color || this.color, mouseon, mouseon ? color : this.data.darksidecolor);
            }
        };
        this.contact = null;
        this.computeinfo = function (forceCompute) {
            if (!this._computeinfo || forceCompute) {
                this._computeinfo = computeSemicircle(this.isClickout, 1, this.angleMin, this.angleMax);
            }
            return this._computeinfo;
        };
        this.click = function (e, color) {
            if (options.clickout) {
                resetOuterLabelPosition = true;
                this.isClickout = !this.isClickout;
                this.computeinfo(true);
                inner.redrawAll();
                var mouseoverTransp = options.mouseoverTransparency;
                var newColor = 'rgba(255,255,255,' + (mouseoverTransp > 0 && mouseoverTransp < 1 ? mouseoverTransp : 0.2) + ')';
                this.redraw(this.isClickout, newColor);
                drawOuterLabels(this, newColor);
            }
            if (!options.clickout || this.isClickout) {
                var click = typeof this.data.click == 'function' ? this.data.click : (options.click || null);
                if (click) {
                    click(this.data, e);
                }
            }
        };
        if (options.tip.show && typeof options.tip.content == 'function') {
            this.tip = null;
            this.showTip = function () {
                if (this.tip) {
                    this.tip.style.display = 'inline';
                }
                else {
                    var midAngle = (this.angleMin + this.angleMax) / 2;
                    var left = radiusInfo.centerX + (pieOuterRadius + pieInnerRadius) / 2 * Math.cos(midAngle);
                    var top = radiusInfo.centerY + (pieOuterRadius + pieInnerRadius) / 2 * Math.sin(midAngle);
                    this.tip = inner._createTip(options.tip.content(this.data), left * zoomX, top * zoomY);
                    var shape = this;
                    shape.tip.onclick = function (e) { shape.click(e); };
                }
            };
            this.hideTip = function () {
                if (this.tip) { this.tip.style.display = 'none'; }
            };
        }
    };

    var drawPart = function (drawtype, clickout, scalePercent, angleMin, angleMax, color, mouseon, darksidecolor, data, pieshape) {
        var computeinfo = computeSemicircle(clickout, scalePercent, angleMin, angleMax);
        darksidecolor = darksidecolor || LChart.Methods.getDarkenColor(color);
        var _linewidth = mouseon ? 0 : linewidth;
        inner.ctx.save();
        inner.ctx.transform(zoomX, 0, 0, zoomY, 0, 0);
        switch (drawtype) {
            case 0:
                inner.DrawFigures.createRingReflection(computeinfo, darksidecolor);
                break;
            case 1:
                inner.DrawFigures.createCloseFigure([[computeinfo.iEndX, computeinfo.iEndY], [computeinfo.d_iEndX, computeinfo.d_iEndY], [computeinfo.d_oEndX, computeinfo.d_oEndY], [computeinfo.oEndX, computeinfo.oEndY]], darksidecolor);
                break;
            case 2:
                inner.DrawFigures.createCloseFigure([[computeinfo.iStartX, computeinfo.iStartY], [computeinfo.d_iStartX, computeinfo.d_iStartY], [computeinfo.d_oStartX, computeinfo.d_oStartY], [computeinfo.oStartX, computeinfo.oStartY]], darksidecolor);
                break;
            default:
                inner.DrawFigures.createRing(computeinfo.centerX, computeinfo.centerY, computeinfo.innerRadius, computeinfo.outerRadius, color, angleMin, angleMax, _linewidth, linecolor);
                if (_linewidth > 0) {
                    if (judgeAngleAtSight(angleMin)) {
                        inner.DrawFigures.createLine(computeinfo.oStartX, computeinfo.oStartY, computeinfo.d_oStartX, computeinfo.d_oStartY, _linewidth, linecolor);
                    }
                    else {
                        inner.DrawFigures.createLine(computeinfo.iStartX, computeinfo.iStartY, computeinfo.d_iStartX, computeinfo.d_iStartY, _linewidth, linecolor);
                    }
                    if (clickout) {
                        if (judgeAngleAtSight(angleMax)) {
                            inner.DrawFigures.createLine(computeinfo.oEndX, computeinfo.oEndY, computeinfo.d_oEndX, computeinfo.d_oEndY, _linewidth, linecolor);
                        }
                        else {
                            inner.DrawFigures.createLine(computeinfo.iEndX, computeinfo.iEndY, computeinfo.d_iEndX, computeinfo.d_iEndY, _linewidth, linecolor);
                        }
                    }
                }
                break
        }
        inner.ctx.restore();
        var ops = options.outerLabel;
        if (data && ops.show && typeof ops.content == 'function') {
            var length = ops.length || pieOuterRadius / 12;
            var floatright = LChart.Methods.JudgeBetweenAngle(-Math.PI * 0.5, Math.PI * 0.5, computeinfo.midAngle);
            var floattop = LChart.Methods.JudgeBetweenAngle(-Math.PI, 0, computeinfo.midAngle);
            var content = ops.content(data);
            var ctxWidth = inner.DrawFigures.measureText(content, null, ops.fontsize || (length - 1), ops.fontfamily);
            var width = ctxWidth + (ops.withlegend ? length + 3 * cutX : 2 * cutX);
            var height = length + cutY * 2;
            var labelshape = new outerLabelShape(content, length, width, height, floatright ? 1 : 0, floattop ? 1 : 0, data, pieshape);
            shapes.outerLabels.push(labelshape);
            pieshape.contact = labelshape;
        }
    };
    var drawInnerLabels = function (_shape) {
        var ops = options.innerLabel;
        if (!(ops.show && typeof ops.content == 'function')) { return; }
        var distance = (ops.distance || 0.5);
        var drawSingleLabel = function (shape) {
            var midAngle = (shape.angleMin + shape.angleMax) / 2;
            var data = shape.data;
            var length = pieInnerRadius + (pieOuterRadius - pieInnerRadius) * distance + (shape.isClickout ? clickoutLength : 0);
            var left = radiusInfo.centerX + length * Math.cos(midAngle);
            var top = radiusInfo.centerY + length * Math.sin(midAngle);
            inner.ctx.save();
            inner.ctx.transform(zoomX, 0, 0, zoomY, 0, 0);
            inner.DrawFigures.createText(ops.content(data), left, top, 'center', data.fontweight, data.fontsize || ops.fontsize || pieOuterRadius / 10, ops.fontfamily, data.fontcolor || ops.color || LChart.Const.Defaults.InnerLabelColor);
            inner.ctx.restore();
        };
        if (_shape) { drawSingleLabel(_shape); }
        else {
            for (var i = 0, shape; shape = shapes.cemicircles[i]; i++) {
                drawSingleLabel(shape);
            }
        }
    };
    var drawOuterLabels = function (_shape, _color) {
        var ops = options.outerLabel;
        if (!(ops.show && typeof ops.content == 'function')) { return; }
        var minY = (isMain ? radiusInfo.coordinate.minY : 5) / zoomY;
        var maxY = (isMain ? radiusInfo.coordinate.maxY : inner.canvas.height - 5) / zoomY;
        shapes.outerLabels.sort(function (s1, s2) { return s1.index - s2.index; });
        if (resetOuterLabelPosition) {
            for (var i = 0, shape; shape = shapes.outerLabels[i]; i++) { shape.resetposition(); }
            resetOuterLabelPosition = false;
        }
        var resetPosition = function () {
            var judgeOuterLabelCross = function (r1, r2) {
                return Math.max(r1.left, r2.left) <= Math.min(r1.left + r1.width, r2.left + r2.width) && Math.max(r1.top, r2.top) <= Math.min(r1.top + r1.height, r2.top + r2.height);
            };
            var lefttop = []; var leftbuttom = []; var righttop = []; var rightbottom = [];
            for (var i = 0, shape; shape = shapes.outerLabels[i]; i++) {
                while (minY > shape.top) {
                    shape.top += cutY;
                    shape.left += shape.floatright ? cutX : -cutX;
                }
                while (maxY < shape.top + shape.height) {
                    shape.top -= cutY;
                    shape.left += shape.floatright ? cutX : -cutX;
                }
                if (shape.floatright && shape.floattop) { righttop.push(shape); }
                else if (shape.floatright && !shape.floattop) { rightbottom.push(shape); }
                else if (!shape.floatright && shape.floattop) { lefttop.push(shape); }
                else { leftbuttom.push(shape); }
            }
            var count = 0;
            var compares = [];
            var cycle = function (r) {
                if (compares.length > 0) {
                    for (var i = 0, compare; compare = compares[i]; i++) {
                        while (judgeOuterLabelCross(compare, r) && count < 1000) {
                            r.top += r.floattop ? cutY : -cutY;
                            r.left += r.floatright ? cutX : -cutX;
                            count++
                        }
                    }
                }
                compares.push(r);
            };
            for (var i = lefttop.length - 1; i >= 0; i--) { cycle(lefttop[i]); }
            compares = [];
            for (var i = 0; i < leftbuttom.length; i++) { cycle(leftbuttom[i]); }
            compares = [];
            for (var i = 0; i < righttop.length; i++) { cycle(righttop[i]); }
            compares = [];
            for (var i = rightbottom.length - 1; i >= 0; i--) { cycle(rightbottom[i]); }
        };
        var drawSingleLabel = function (labelshape, color) {
            var shape = labelshape;
            inner.ctx.save();
            inner.ctx.transform(zoomX, 0, 0, zoomY, 0, 0);
            if (!color) {
                inner.DrawFigures.createQuadraticCurve(shape.startX, shape.startY, shape.startX * 0.8 + shape.endX() * 0.2, shape.startY * 0.2 + shape.endY() * 0.8, shape.endX(), shape.endY(), 1, ops.bordercolor);
                if (ops.backcolor) {
                    inner.DrawFigures.createRectangleFill(shape.left, shape.top, shape.width, shape.height, ops.backcolor);
                }
                var fontsize = ops.fontsize || (shape.length - 1);
                var left = shape.left + (shape.floatright ? cutX + (ops.withlegend ? shape.length + cutX : 0) : shape.width - cutX);
                var top = shape.top + shape.length / 2 + fontsize / 2 + cutY / 2;
                inner.DrawFigures.createText(shape.content, left, top, shape.floatright ? 'left' : 'right', null, fontsize, ops.fontfamily, ops.color);
                if (ops.borderwidth && ops.borderwidth > 0) {
                    inner.DrawFigures.createRectangleBorder(shape.left, shape.top, shape.width, shape.height, ops.borderwidth, ops.bordercolor);
                }
            }
            if (ops.withlegend) {
                var legendtype = ops.legendtype || 's';
                var color = color || shape.color;
                inner.DrawFigures.createPointElement(legendtype, shape.left + cutX, shape.top + cutY, shape.length, color, legendtype != 'x', color, 2, legendtype == 'x');
            }
            inner.ctx.restore();
        };
        if (_shape) {
            drawSingleLabel(_shape.contact, _color);
        }
        else {
            resetPosition();
            inner.coordinates.ring[graphicID].outerlabels.length = 0;
            for (var i = 0, shape; shape = shapes.outerLabels[i]; i++) {
                drawSingleLabel(shape);
                inner.coordinates.ring[graphicID].outerlabels[i] = { index: shape.contact.index, left: shape.left, top: shape.top, width: shape.width, height: shape.height };
            }
        }
    };

    var drawSegments = function (animationDecimal, percentAnimComplete) {
        var scaleAnimation = options.animation && options.animateScale ? animationDecimal : 1;
        var rotateAnimation = options.animation && options.animateRotate ? animationDecimal : 1;
        var complete = percentAnimComplete >= 1;
        var pieshapes = [];
        var cumulativeAngle = initialStartAngle;
        for (var i = 0, item; item = innerData[i]; i++) {
            var percent = (item.value / segmentTotal) * 100;
            var rotate = percent / 100 * Math.PI * 2 * rotateAnimation;
            var color = item.color || colors[i % colors.length];
            var angleMin = cumulativeAngle;
            var angleMax = cumulativeAngle + inner._formatSegmentAngle(rotate);
            var midAngle = (angleMin + angleMax) / 2;
            if (complete) {
                item.percent = percent;
                inner.coordinates.ring[graphicID].cemicircles.push({ index: i, percent: percent, angleMin: angleMin, angleMax: angleMax, color: color });
            }
            var _pieshape = new pieshape(i, color, percent, angleMin, angleMax, midAngle, item, item.extended);
            pieshapes.push(_pieshape);
            cumulativeAngle += rotate;
        }
        faces = inner._get3DFaceDrawOrder(pieshapes, reflectoffX, reflectoffY);
        for (var i = 0, face; face = faces[i]; i++) {
            drawPart(face.type, face.shape.data.extended, scaleAnimation, face.shape.angleMin, face.shape.angleMax, face.shape.color, false, face.shape.data.darksidecolor, complete && face.type == 3 ? face.shape.data : null, complete && face.type == 3 ? face.shape : null);
        }
        if (complete) {
            shapes.cemicircles = pieshapes;
            shapes.faces = faces;
            drawInnerLabels();
            drawOuterLabels();
        }
    };
    var mouseEvents = function () {
        var fixShape = function (x, y) {
            var veryShape = null;
            for (var i = 0, shape; shape = shapes.cemicircles[i]; i++) {
                var computeinfo = shape.computeinfo();
                var currentAngle = LChart.Methods.GetCurrentAngle(x, y, computeinfo.centerX, computeinfo.centerY);
                var distance2 = Math.pow(x - computeinfo.centerX, 2) + Math.pow(y - computeinfo.centerY, 2);
                var withinPie = distance2 >= Math.pow(pieInnerRadius, 2) && distance2 <= Math.pow(pieOuterRadius, 2) && LChart.Methods.JudgeBetweenAngle(shape.angleMin, shape.angleMax, currentAngle);
                var withinOuterLabel = false;
                if (options.outerLabel && options.outerLabel.show && shape.contact) {
                    var rectangle = shape.contact;
                    if (x >= rectangle.left && x <= rectangle.left + rectangle.width && y >= rectangle.top && y <= rectangle.top + rectangle.height) {
                        withinOuterLabel = true;
                    }
                }
                if (withinPie || withinOuterLabel) {
                    veryShape = shape; break;
                }
            }
            if (!veryShape) {
                for (var i = shapes.cemicircles.length - 1; i >= 0; i--) {
                    var shape = shapes.cemicircles[i];
                    var computeinfo = shape.computeinfo();
                    var distance2 = Math.pow(x - computeinfo.darkCenterX, 2) + Math.pow(y - computeinfo.darkCenterY, 2);
                    var currentDarkAngle = LChart.Methods.GetCurrentAngle(x, y, computeinfo.darkCenterX, computeinfo.darkCenterY);
                    var withinDarkPie = distance2 >= Math.pow(pieInnerRadius, 2) && distance2 <= Math.pow(pieOuterRadius, 2) && LChart.Methods.JudgeBetweenAngle(shape.angleMin, shape.angleMax, currentDarkAngle);
                    if (withinDarkPie) {
                        veryShape = shape; break;
                    }
                }
            }
            return veryShape;
        };
        var onclick = function (e) {
            var e = window.event || e;
            var location = LChart.Methods.tranferLocation(inner._getMouseLoction(e), zoomX, zoomY);
            var veryShape = fixShape(location.X, location.Y);
            if (veryShape) {
                veryShape.click(e);
            }
        };
        var onmousemove = function (e) {
            var e = window.event || e;
            var location = LChart.Methods.tranferLocation(inner._getMouseLoction(e), zoomX, zoomY);
            var veryShape = fixShape(location.X, location.Y);
            if (veryShape) { inner._configs.cursorPointer = true; }
            if (specificConfig.currentMouseShape != veryShape) {
                var shape = specificConfig.currentMouseShape;
                if (shape) {
                    var mouseleave = typeof shape.data.mouseleave == 'function' ? shape.data.mouseleave : (options.mouseleave || null);
                    if (mouseleave) {
                        mouseleave(shape.data, e);
                    }
                }
                if (specificConfig.currentMouseShape) {
                    inner.redrawAll();
                }
                specificConfig.currentMouseShape = veryShape;
                for (var i = 0, shape; shape = shapes.cemicircles[i]; i++) {
                    if (shape.isHovered) {
                        shape.isHovered = false;
                        if (shape.hideTip) { shape.hideTip(); }
                    }
                }
                if (veryShape) {
                    veryShape.isHovered = true;
                    var mouseoverTransp = options.mouseoverTransparency;
                    var newColor = 'rgba(255,255,255,' + (mouseoverTransp > 0 && mouseoverTransp < 1 ? mouseoverTransp : 0.2) + ')';
                    veryShape.redraw(veryShape.isClickout, newColor);
                    drawOuterLabels(veryShape, newColor);
                    if (veryShape.showTip) { veryShape.showTip(); }
                    var mouseover = typeof veryShape.data.mouseover == 'function' ? veryShape.data.mouseover : (options.mouseover || null);
                    if (mouseover) {
                        mouseover(veryShape.data, e);
                    }
                }
            }
        };
        inner._addEventListener('click', onclick);
        inner._addEventListener('mousemove', onmousemove);
    };
    var redraw = function () {
        for (var i = 0, face; face = shapes.faces[i]; i++) {
            drawPart(face.type, face.shape.isClickout, 1, face.shape.angleMin, face.shape.angleMax, face.shape.color, null, face.shape.data.darksidecolor);
        }
        drawInnerLabels();
        drawOuterLabels();
    };
    return { drawSegments: drawSegments, mouseEvents: mouseEvents, redraw: redraw };
};
