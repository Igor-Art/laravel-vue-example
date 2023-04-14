import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/**
 * https://fontawesome.com/icons
 */

import {
  faUser,
  faRightFromBracket,
  faStar,
  faComments,
  faAnglesRight,
  faCode,
} from '@fortawesome/free-solid-svg-icons'

import {
  faGithub,
} from '@fortawesome/free-brands-svg-icons'

library.add(
  faUser,
  faRightFromBracket,
  faStar,
  faComments,
  faAnglesRight,
  faCode,
  faGithub,
)

export default FontAwesomeIcon
