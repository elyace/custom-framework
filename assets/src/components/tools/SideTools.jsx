import React, {Suspense, useEffect, useState} from 'react'
import {subscribe} from "../../shared/event.js";
import {BsFillArrowRightCircleFill} from "react-icons/bs";

import './side-tools.css'

const SideTools = () => {

    const [ComponentContainer, setComponentContainer] = useState(undefined)

    const [show, setShow] = useState(false)

    useEffect(() => {
        subscribe('show-side-tools', e => {
            setShow(true)
            setComponentContainer(e.detail)
        })
    }, [])

    useEffect(() => {
        subscribe('hide-side-tools', () => {
            setShow(false)
            setComponentContainer(undefined)
        })
    }, [])

    return <div className={`side-tools ${show ? 'show' : ''}`}>
        <div>
            <span className="close-bg"></span>
            <a href="" className='close' onClick={(e) => {
                e.preventDefault()
                setShow(false)
            }}>
                <BsFillArrowRightCircleFill/>
            </a>
            <div className='side-tools__content'>
                {
                    ComponentContainer && <Suspense fallback={'Chargement en cours ...'}>
                        <ComponentContainer/>
                    </Suspense>
                }
            </div>
        </div>
    </div>
}

export default SideTools
