import { Clock, Color, PlaneBufferGeometry, ShaderMaterial, SceneUtils } from 'three';

class terrain {
  constructor(scene, options) {
    this.uniforms = null;
    this.plane_mesh = null;
    this.plane_geometry = null;
    this.groundMaterial = null;
    this.clock = new Clock(true);
    this.scene = scene;
    this.options = options;

    this.init = this.init.bind(this);
    this.buildPlanes = this.buildPlanes.bind(this);
    this.update = this.update.bind(this);

    this.init();
  }

  init() {
    this.uniforms = {
      time: {
        type: 'f',
        value: 0.0,
      },
      speed: {
        type: 'f',
        value: this.options.speed,
      },
      elevation: {
        type: 'f',
        value: this.options.elevation,
      },
      noise_range: {
        type: 'f',
        value: this.options.noise_range,
      },
      offset: {
        type: 'f',
        value: this.options.elevation,
      },
      perlin_passes: {
        type: 'f',
        value: this.options.perlin_passes,
      },
      sombrero_amplitude: {
        type: 'f',
        value: this.options.sombrero_amplitude,
      },
      sombrero_frequency: {
        type: 'f',
        value: this.options.sombrero_frequency,
      },
      line_color: {
        type: 'c',
        value: new Color(this.options.wireframe_color),
      },
    };

    this.buildPlanes(this.options.segments);
  }

  buildPlanes(segments) {
    this.plane_geometry = new PlaneBufferGeometry(20, 20, segments, segments);

    this.plane_material = new ShaderMaterial({
      vertexShader: document.getElementById('shader-vertex-terrain-perlinsombrero').textContent,
      fragmentShader: document.getElementById('shader-fragment-terrain').textContent,
      wireframe: this.options.wireframe,
      wireframeLinewidth: 1,
      transparent: true,
      uniforms: this.uniforms,
    });

    this.materials = [this.plane_material];
    this.plane_mesh = SceneUtils.createMultiMaterialObject(this.plane_geometry, this.materials);
    this.plane_mesh.rotation.x = -Math.PI / 2;

    return this.plane_mesh.position.y = -0.5;
  }

  update() {
    return this.plane_material.uniforms['time'].value = this.clock.getElapsedTime();
  }
}

export default terrain;
