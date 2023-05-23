import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/**
 * https://fontawesome.com/search?o=r&m=free
 */

import {
  faUser,
  faRightFromBracket,
  faStar,
  faComments,
  faAnglesRight,
  faAnglesDown,
  faCode,
  faGamepad,
  faCheckDouble,
  faFileExcel,
  faHeart,
  faBullhorn,
  faPencil,
} from '@fortawesome/free-solid-svg-icons'

import {
  faStar as faStarEmpty,
} from '@fortawesome/free-regular-svg-icons'

import {
  faGithub,
} from '@fortawesome/free-brands-svg-icons'

library.add(
  faUser,
  faRightFromBracket,
  faStar,
  faStarEmpty,
  faComments,
  faAnglesRight,
  faAnglesDown,
  faCode,
  faGithub,
  faGamepad,
  faCheckDouble,
  faFileExcel,
  faHeart,
  faBullhorn,
  faPencil,
)

export default FontAwesomeIcon
