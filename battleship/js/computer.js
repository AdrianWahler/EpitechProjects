/*jslint browser this */
/*global _, player */

(function (global) {
    "use strict";

    var computer = _.assign({}, player, {
        type: "computer",
        grid: [],
        tries: [],
        fleet: [],
        lastHitCoordinates: [],
        queuedMoves: [],
        game: null,
        setGame: function (parent){
            this.game = parent;
        },
        init: function () {
            // créé la flotte
            this.fleet.push(shipFactory.build(shipFactory.TYPE_BATTLESHIP));
            this.fleet.push(shipFactory.build(shipFactory.TYPE_DESTROYER));
            this.fleet.push(shipFactory.build(shipFactory.TYPE_SUBMARINE));
            this.fleet.push(shipFactory.build(shipFactory.TYPE_SMALL_SHIP));

            // créé les grilles
            this.grid = utils.createGrid(10, 10);
            this.tries = utils.createGrid(10, 10);
        },
        play: function () {
            var self = this;
            if (this.queuedMoves.length == 0 || this.game.easyMode){
                do {
                    var x = Math.floor(Math.random()*10);
                    var y = Math.floor(Math.random()*10);
                } while (this.tries[x][y] !== 0);
            } else {
                do {
                    var chosenMoveIndex = Math.floor(Math.random() * this.queuedMoves.length);
                    var chosenMove = this.queuedMoves[chosenMoveIndex];
                    this.queuedMoves.splice(chosenMoveIndex,1);
                } while (chosenMove[0] < 0 || chosenMove[0] > 9 || 
                    chosenMove[1] < 0 || chosenMove[1] > 9 || 
                    this.tries[chosenMove[0]][chosenMove[1]] !== 0 && this.queuedMoves.length > 0);
                if (chosenMove.length != 0 && this.tries[chosenMove[0]][chosenMove[1]] == 0) {
                    var x = chosenMove[0];
                    var y = chosenMove[1];
                } else {
                    do {
                        var x = Math.floor(Math.random()*10);
                        var y = Math.floor(Math.random()*10);
                    } while (this.tries[x][y] !== 0);
                }
            }
            setTimeout(function () {
                self.game.fire(this, x, y, function (hasSucced) {
                    self.tries[x][y] = hasSucced;
                    //si on a touché, on garde la coordonée en mémoire
                    if (hasSucced) {
                        self.lastHitCoordinates = [x,y];
                        self.queuedMoves = self.queuedMoves.concat([[x+1,y],[x-1,y],[x,y+1],[x,y-1]]);
                    }
                    self.renderTries(self.game.miniGrid);
                });
            }, 2000); //2000
        },
        computerSetActiveShipPosition: function () {
            var ship = this.activeShip;
            var i = 0;
            var x = Math.floor(Math.random()*10)
            var y = Math.floor(Math.random()*10)
            var placeHorizontally = Math.random() >= 0.5
            var offset = Math.floor(ship.getLife() / 2)
            if (placeHorizontally){
                var horizontal = 1;
                var vertical = 0;
            } else {
                var horizontal = 0;
                var vertical = 1;
            }

            while (i < ship.getLife()) {
                if(x + (i - offset) * horizontal < 0 || x + (i - offset) * horizontal > 9 || y + (i - offset) * vertical < 0 || y + (i - offset) * vertical> 9) {
                    return false;
                }
                else if (this.grid[y + (i - offset) * vertical][x + (i - offset) * horizontal] != 0){
                    return false;
                }
                i += 1;
            }

            i = 0;

            while (i < ship.getLife()) {
                this.grid[y + (i - offset) * vertical][x + (i - offset) * horizontal] = ship.getId();
                i += 1;
            }
            return true;
        },
        renderTries: function (grid) {
            this.tries.forEach(function (row, rid) {
                row.forEach(function (val, col) {
                    var node = grid.querySelector('.row:nth-child(' + (rid + 1) + ') .cell:nth-child(' + (col + 1) + ')');

                    if (val === true) {
                        node.style.backgroundColor = '#ff0088';
                    } else if (val === false) {
                        node.style.backgroundColor = '#aeaeae';
                    }
                });
            });
        },
        areShipsOk: function (callback) {
            this.fleet.forEach(function (ship, i) {
                this.activeShip = ship;
                while (this.computerSetActiveShipPosition() != true) {
                    //repeat
                }
            }, this);
            setTimeout(function () {
                callback();
            }, 500); //500
        }
    });

    global.computer = computer;

}(this));