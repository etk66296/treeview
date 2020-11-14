class TreeviewObject {
  constructor(renderSurface) {
    this.renderSurface = renderSurface
  }
}

function renderLineStrings(data, surface) {
  if (data.type === 'LineString') {
    pathString = ''
    data.coordinates.forEach(coordinates => {
      pathString += String(coordinates[0])
      pathString += ', '
      pathString += String(coordinates[1])
      pathString += ', '
    })
    pathString = pathString.slice(0, pathString.length - 2)
    surface.polyline(pathString).fill('none').stroke({ color: '#000', width: 1, linecap: 'round' })
  }
}
function renderPolygons(data, surface) {
  if (data.type === 'Polygon') {
    pathString = ''
    // console.log(data)
    data.coordinates.forEach((vertices) => {
      vertices.forEach(vertex => {
        pathString += String(vertex[0])
        pathString += ', '
        pathString += String(vertex[1])
        pathString += ', '
      })
    })
    pathString = pathString.slice(0, pathString.length - 2)
    let fillColor = 'none'
    if (data.properties.landuse ==='asphalt') {
      fillColor = '#888888'
    } else if (data.properties.landuse ==='grass') {
      fillColor = '#55ff55'
    }
    surface.polygon(pathString).fill(fillColor).stroke({ color: '#000', width: 1, linecap: 'round' })
  }
}

class Tree {
  constructor(pos, size, id = 0, image = '', kind = '', sort = '', note = '') {
    this.pos = { cx: pos.cx, cy: pos.cy }
    this.size = size
    this.id = id
    this.image = image
    this.kind = kind
    this.sort = sort
    this.note = note

    this.crown = null
    this.trunk = null
  }
}

class Meadow extends TreeviewObject {
  constructor(renderSurface, vertices, pos = {x: 0, y: 0}) {
    super(renderSurface)
    this.renderSurface = renderSurface
    this.trees = []
    // a meadows start vertex is last vertex
    vertices.push(vertices[0])
    vertices.push(vertices[1])

    // draw the polyline
    this.meadow = this.renderSurface.polyline(vertices)
    this.meadow.fill('#33ff33')
    this.meadow.stroke({ color: '#000', width: 2, linecap: 'round', linejoin: 'round' })
  }
  addTree(tree) {
    let rCrown = 0
    let rTrunk = 0
    switch(tree.size) {
      case 1:
        rCrown = 20
        rTrunk = 4
      break
      case 2:
        rCrown = 30
        rTrunk = 6
      break
      case 3:
        rCrown = 40
        rTrunk = 8
      break
      default:
      break
    }
    tree.crown = this.renderSurface.circle(rCrown).fill('#8db900').attr({ cx: tree.pos.cx, cy: tree.pos.cy })//.move(tree.pos.x, tree.pos.y)
    tree.trunk = this.renderSurface.circle(rTrunk).fill('#984200').attr({ cx: tree.pos.cx, cy: tree.pos.cy })//.move(tree.pos.x, tree.pos.y)
    this.trees.push(tree)

  }
}