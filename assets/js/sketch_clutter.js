var Engine = Matter.Engine,
    Runner = Matter.Runner,
    Bodies = Matter.Bodies,
    Composite = Matter.Composite,
    Mouse = Matter.Mouse,
    MouseConstraint = Matter.MouseConstraint;

var unitRes = 200;
var yRes = 50;

var spacer;

var pgT = [];
var tFont = [];
var pgTextSize;
var pgStripH;

var color1, color2, color3;
var bkgdColor, foreColor, typeColor;

var keyText;
var keyArray = [];
var alphaStep = 0;

var grfx = [];
var pg_grfx = [];
var m_3Dgrfx = [];

var gOptionCount = 17;

var widgetOn = false;

var engine;
var runner;
var circ = [];
var mConstraint;

function preload(){
  // Use system fonts instead of custom font files
  tFont[0] = 'sans-serif';
  tFont[1] = 'serif';
}

function setup(){
  var canvas = createCanvas(windowWidth, windowHeight, WEBGL);
  canvas.parent('bg-animation');

  pgTextSize = 150;
  pgStripH = pgTextSize * 0.8;

  engine = Engine.create();
  runner = Runner.create();

  Runner.run(runner, engine);

  groundBot = Bodies.rectangle(width/2, height + 40, width, 80, {isStatic:true});
  groundRight = Bodies.rectangle(width + 40, height/2, 80, height, {isStatic:true});
  groundTop = Bodies.rectangle(width/2, -40, width, 80, {isStatic:true});
  groundLeft = Bodies.rectangle(-40, height/2, 80, height, {isStatic:true});

  Composite.add(engine.world, [groundBot, groundRight, groundTop, groundLeft]);

  bkgdColor = color('#ffffff');
  typeColor = color('#e8e8e8');

  foreColor = color('#d0d0d0');
  color1 = color('#c8c8c8');
  color2 = color('#e0e0e0');
  color3 = color('#d5d5d5');

  frameRate(30);
  textureMode(NORMAL);

  // Update mobile scale now that windowWidth is available
  _updateMobileScale();

  // Set text from hidden textarea
  setText();

  var canvasmouse = Mouse.create(canvas.elt);
  canvasmouse.pixelRatio = pixelDensity();
  var options = {
    mouse: canvasmouse
  };
  mConstraint = MouseConstraint.create(engine, options);

  Composite.add(engine.world, mConstraint);

  var _isMobile = (windowWidth < 768);
  var grfxCount = _isMobile ? 5 : 16;
  for(var g = 0; g < grfxCount; g++){
    generateGrfx();
  }
}

function draw(){
  background(bkgdColor);

  translate(-width/2, -height/2);

  engine.world.gravity.scale = 0.0000;

  // grfx - 3D
  push();
    for(var g = 0; g < grfx.length; g++){
      if(grfx[g].mode == 1){
        grfx[g].display();
      }
    }
  pop();

  // grfx - 2D
  push();
    for(var g = 0; g < grfx.length; g++){
      if(grfx[g].mode == 0){
        grfx[g].display();
      }
    }
  pop();

  // text
  push();
    translate(width/2, height/2);
    translate(0, -(keyArray.length - 1) * pgStripH / 2);
    for(var k = 0; k < keyArray.length; k++){
      push();
        translate(-pgT[k].width/2, -pgT[k].height/2);
        translate(0, k * pgStripH);
        image(pgT[k], 0, 0);
      pop();
    }
  pop();

  for(var i = 0; i < circ.length; i++){
    circ[i].show();
  }

  if(alphaStep > 0){
    alphaStep -= 0.075;
  }

  if(alphaStep < 0.1 && alphaStep > -0.1){
    alphaStep = 0;
  }
}

function mouseMoved() {
}

function keyPressed(){
  generateGrfx();
}

function generateGrfx(){
  grfx[grfx.length] = new M_Grfx(grfx.length);

  var xRan = random(-30, 30);
  var yRan = random(-30, 30);
  circ.push(new Circ(width/2 + xRan, height/2 + yRan, 80));
}

function windowResized(){
  resizeCanvas(windowWidth, windowHeight, WEBGL);

  Matter.Body.setPosition(groundBot, {x: width/2, y: height + 40});
  Matter.Body.setPosition(groundRight, {x: width + 40, y: height/2});
  Matter.Body.setPosition(groundTop, {x: width/2, y: -40});
  Matter.Body.setPosition(groundLeft, {x: -40, y: height/2});
}

function sinEngine(aCount, aLength, bCount, bLength, Speed, slopeN) {
  var sinus = sin((frameCount * Speed + aCount * aLength + bCount * bLength));
  var sign = (sinus >= 0 ? 1 : -1);
  var sinerSquare = sign * (1 - pow(1 - abs(sinus), slopeN));
  return sinerSquare;
}
