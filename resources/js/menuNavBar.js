import {
  mdiMenu,
  mdiClockOutline,
  mdiCloud,
  mdiCrop,
  mdiAccount,
  mdiCogOutline,
  mdiEmail,
  mdiLogout,
  mdiThemeLightDark,
  mdiGithub,
  mdiReact
} from '@mdi/js'

export default [
  {
    icon: mdiThemeLightDark,
    label: 'Light/Dark',
    isDesktopNoLabel: true,
    isToggleLightDark: true
  },
  {
    icon: mdiGithub,
    label: 'GitHub',
    isDesktopNoLabel: true,
    href: 'https://github.com/justboil/admin-one-vue-tailwind',
    target: '_blank'
  },
  {
    icon: mdiLogout,
    label: 'Log out',
    isDesktopNoLabel: true,
    isLogout: true
  }
]
