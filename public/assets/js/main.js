(function() {
	var canvas = document.getElementById('life');
	var ctx = canvas.getContext('2d');

	var COLORS = {
		WHITE: 0,
		BLUE: 1
	};

	var width = 100;
	var height = 50;

	var grid = new Uint16Array(width * height);
    var buffer;
	var ticked = 0;

	reset();

	function main(timestamp) {
		window.requestAnimationFrame(main);

		if (timestamp > ticked + 100) {
			ticked = timestamp;
			update();
		}
	}

	function update() {
		draw();
        life();
	}

	function reset() {
		grid = new Uint16Array(width * height);

        for (var i = 0; i < 10; ++i)
            grid[40 + i + width * 25] = COLORS.BLUE;
	}

	function draw() {
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		ctx.fillStyle = '#eee';
		ctx.fillRect(0, 0, canvas.width, canvas.height);

		for (var x = 0; x < width; ++x)
			for (var y = 0; y < height; ++y)
				fillSquare(x, y, grid[x + width * y]);
	}

	function toPos(vec) {
		return [(vec[0] * 4), (vec[1] * 4)];
	}

	function fromPos(vec) {
		return [Math.floor(vec[0] / 4), Math.floor(vec[1] / 4)];
	}

	function fillSquare(x, y, val) {
		switch (val) {
			case COLORS.BLUE:
				ctx.fillStyle = '#09D';
				break;
			case COLORS.WHITE:
				ctx.fillStyle = '#fff';
				break;
			default:
				ctx.fillStyle = '#eee';
		}
		ctx.fillRect(x*4, y*4, 3, 3);
	}

    function life() {
        buffer = grid.slice();

        for (var x = 0; x < width; ++x) {
            for (var y = 0; y < height; ++y) {
                var count = neighbors(x, y);
                if (grid[x + width * y] == COLORS.BLUE) {
                    rulePopulated(x, y, count);
                } else {
                    ruleEmpty(x, y, count);
                }
            }
        }
        grid = buffer.slice();
    }

    function rulePopulated(x, y, neighbors) {
        if (neighbors < 2) {
            buffer[x + width * y] = COLORS.WHITE;
            return;
        }

        if (neighbors > 3)
            buffer[x + width * y] = COLORS.WHITE;
    }

    function ruleEmpty(x, y, neighbors) {
        if (neighbors == 3)
            buffer[x + width * y] = COLORS.BLUE;
    }

    function neighbors(x, y) {
        var count = 0;
        for (var i = -1; i <= 1; ++i) {
            for (var j = -1; j <= 1; ++j) {
                if (i == 0 && j == 0)
                    continue;
                if (grid[x + i + width * (y + j)] == COLORS.BLUE)
                    ++count;
            }
        }
        return count;
    }

	main(performance.now());
})();