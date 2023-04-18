/*jslint browser this */
/*global _, shipFactory, player, utils */

(function (global) {
    "use strict";

    var player = {
        type: "player",
        grid: [],
        tries: [],
        fleet: [],
        recommendedMoves: [],
        game: null,
        placeHorizontally: true,
        activeShip: 0,
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
        play: function (col, line) {
            //verification de si le tir a déjà été fait
            if (this.tries[line][col] !== 0){
                utils.info("Cette case a déjà été bombardée...");
                return;
            }
            // appel la fonction fire du game, et lui passe une
            // calback pour récupérer le résultat du tir
            this.game.fire(this, col, line, _.bind(function (hasSucced) {
                this.tries[line][col] = hasSucced;
                if (hasSucced){
                    this.recommendedMoves =
                    this.recommendedMoves.concat(
                        [[line+1,col],[line-1,col],[line,col+1],[line,col-1]]
                    );
                }
            }, this));
            this.renderTries(this.game.grid);
        },
        // quand il est attaqué le joueur doit dire si il a un bateaux ou
        // non à l'emplacement choisi par l'adversaire
        receiveAttack: function (col, line, callback) {
            var succeed = false;
            var hitShipId = this.grid[col][line];

            if (this.grid[col][line] !== 0) {
                succeed = true;
                    this.fleet.forEach(function(ship) {
                        if (ship.getId() == hitShipId){
                            ship.setLife(ship.getLife()-1);
                            if (this.type == "player") {
                                if (ship.getLife() == 0){
                                    document.querySelector(
                                        "."+ship.getName().toLowerCase()
                                    ).classList.add("sunk");
                                }
                            }
                        }
                    });
                this.grid[col][line] = 0;
            }
            callback.call(undefined, succeed);
        },
        setActiveShipPosition: function (x, y) {
            var horizontal = 0;
            var vertical = 0;
            var ship = this.fleet[this.activeShip];
            var i = 0;
            var offset = Math.floor(ship.getLife() / 2)
            if (this.placeHorizontally){
                horizontal = 1;
            } else {
                vertical = 1;
            }

            while (i < ship.getLife()) {
                if(x + (i - offset) * horizontal < 0
                    || x + (i - offset) * horizontal > 9
                    || y + (i - offset) * vertical < 0
                    || y + (i - offset) * vertical> 9) {
                    return false;
                } else if (this.grid[y + (i - offset) * vertical]
                    [x + (i - offset) * horizontal] != 0){
                    return false;
                }
                i += 1;
            }

            i = 0;

            while (i < ship.getLife()) {
                this.grid[y + (i - offset) * vertical]
                        [x + (i - offset) * horizontal] = ship.getId();
                i += 1;
            }
            return true;
        },
        clearPreview: function () {
            this.fleet.forEach(function (ship) {
                if (ship.dom.parentNode) {
                    ship.dom.parentNode.removeChild(ship.dom);
                }
            });
        },
        resetShipPlacement: function () {
            this.clearPreview();

            this.activeShip = 0;
            this.grid = utils.createGrid(10, 10);
        },
        activateNextShip: function () {
            if (this.activeShip < this.fleet.length - 1) {
                this.activeShip += 1;
                return true;
            } else {
                return false;
            }
        },
        renderTries: function (grid) {
            self = this;
            this.tries.forEach(function (row, rid) {
                row.forEach(function (val, col) {
                    var node = grid.querySelector(".row:nth-child("
                    + (rid + 1) +") .cell:nth-child(" + (col + 1) + ")");

                    if (val === true) {
                        node.style.backgroundColor = "#e60019";
                    } else if (val === false) {
                        node.style.backgroundColor = "#aeaeae";
                    }
                });
            });
        },
        renderShips: function (grid) {
            this.fleet.forEach(element => {
                grid.appendChild(element.dom);
            });
        },
        displayRecommendedMove(grid){
            if (!this.game.easyMode){
                return;
            }
            console.log(this.recommendedMoves);
            if (this.recommendedMoves.length == 0){
                do {
                    var x = Math.floor(Math.random()*10);
                    var y = Math.floor(Math.random()*10);
                } while (this.tries[x][y] !== 0);
            } else {
                do {
                    var chosenMoveIndex = Math.floor(
                        Math.random() * this.recommendedMoves.length
                    );
                    var chosenMove = this.recommendedMoves[chosenMoveIndex];
                    this.recommendedMoves.splice(chosenMoveIndex,1);
                } while (chosenMove[0] < 0 || chosenMove[0] > 9 ||
                    chosenMove[1] < 0 || chosenMove[1] > 9 ||
                    this.tries[chosenMove[0]][chosenMove[1]] !== 0
                    && this.recommendedMoves.length > 0);

                if (chosenMove.length != 0
                    && this.tries[chosenMove[0]][chosenMove[1]] == 0) {
                    var x = chosenMove[0];
                    var y = chosenMove[1];
                } else {
                    do {
                        var x = Math.floor(Math.random()*10);
                        var y = Math.floor(Math.random()*10);
                    } while (this.tries[x][y] !== 0);
                }
            }

            console.log(x,y);
            if (document.querySelector(".recommendedSquare") != null) {
                document.querySelector(".recommendedSquare")
                .classList.remove("recommendedSquare");
            }
            var node = grid.querySelector(".row:nth-child(" + (x+1) +
            ") .cell:nth-child(" + (y+1) + ")");
            node.classList.add("recommendedSquare");

        }
    };

    global.player = player;

}(this));