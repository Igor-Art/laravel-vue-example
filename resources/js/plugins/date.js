import { format, formatDistance, parseISO } from 'date-fns'
import config from '@/config/date'

const dateFnsFormat = (date, dateFormat) => format(parseISO(date), dateFormat)

const DateAdapter = {
  config,
  format: (date, dateFormat = config.format.dateTime) => dateFnsFormat(date, dateFormat),
  formatDate: (date, dateFormat = config.format.date) => dateFnsFormat(date, dateFormat),
  formatTime: (date, dateFormat = config.format.time) => dateFnsFormat(date, dateFormat),
  ago: (date, from = Date.now()) => formatDistance(parseISO(date), from, { addSuffix: true })
}

export default {
  install: (app, options) => {
    app.config.globalProperties.$date = DateAdapter
  }
}
