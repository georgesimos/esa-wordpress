import { Scene, PerspectiveCamera, WebGLRenderer, Vector3 } from 'three';
import Terrain from '../util/terrain';

class Mountains {
  constructor(terrainOptions) {
    this.canvasGL = null;
    this.container = document.createElement('div');
    this.scene = new Scene();
    this.camera = new PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 100000);
    this.geometry = null;
    this.material = null;
    this.mesh = null;
    this.terrain = null;
    this.composer = null;
    this.render_pass = null;
    this.fxaa_pass = null;
    this.posteffect = false;
    this.meteo = null;
    this.skybox = null;
    this.terrainOptions = terrainOptions;
    this.renderer = new WebGLRenderer({
      width: window.innerWidth,
      height: window.innerHeight,
      scale: 1,
      antialias: false,
      alpha: true,
    });

    this.init = this.init.bind(this);
    this.update = this.update.bind(this);
    this.renderScene = this.renderScene.bind(this);
    this.resize = this.resize.bind(this);

    this.init();

    $(window).on('resize', () => {
      this.resize(window.innerWidth, window.innerHeight);
    });
  }

  init() {
    this.camera.position.z = 7;
    this.camera.position.y = 1;
    this.camera.lookAt(new Vector3());

    this.renderer.setSize(window.innerWidth, window.innerHeight);

    this.container.id = 'canvasGL';
    this.container.appendChild(this.renderer.domElement);
    document.getElementById('mountains-bg').appendChild(this.container);

    this.terrain = new Terrain(this.scene, this.terrainOptions);
    this.scene.add(this.terrain.plane_mesh);

    return this.update();
  }

  update() {
    window.requestAnimationFrame(this.update);
    this.terrain.update();

    return this.renderScene();
  }

  renderScene() {
    return this.renderer.render(this.scene, this.camera);
  }

  resize(stageWidth, stageHeight) {
    this.camera.aspect = stageWidth / stageHeight;
    this.camera.updateProjectionMatrix();
    return this.renderer.setSize(stageWidth, stageHeight);
  }
}

export default Mountains;
